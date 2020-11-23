<?php

namespace App\Http\Controllers;

use App\Journal;
use App\Models\SubmissionAuthor;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $journals = Journal::paginate(10);   
        
        //  DB::table('journal_author_link')   
        //                 ->join('article_authors','journal_author_link.author_id','article_authors.id')
        //                 ->orderBy('journal_author_link.id','ASC')
        //                 ->get();
                        
                        
        $journals = DB::table('journals')
                  ->select('journals.id as id','journals.name as name', 'journals.authors_ids as authors_ids','submission_types.name as typeName')
                  ->join('submission_types','submission_types.id','journals.type')   
                  ->orderBy('journals.id','DESC')
                  ->get();   
        // dd($journals);          
        $authors = DB::table('article_authors')->get();
        return view('editor.journal.index', compact('journals', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = DB::table('article_authors')->get();
        $volumes = DB::table('volumes')->get();
        $types = DB::table('submission_types')->get();
        return view('editor.journal.create', compact('authors','volumes','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'authors_ids' => 'required',
            'volume' => 'required',
            'type' => 'required',
            'pdf' => 'required|mimes:pdf|max:40400'
        ]);
        // return $request->all();
    

        DB::beginTransaction();
       
        try{
            $journal = new Journal;
            $journal->name = $request->name;

            $journal_sname= str_replace(array("", "\"", "&quot;"), "", $journal->name );
            $journal_name = htmlspecialchars(preg_replace('/\s+/', '-', $journal_sname));
            // dd($journal_name);

            $pdf = $request->file('pdf');
            if (isset($pdf)) {
                $pdf_name = $journal_name . '-' . time() . '.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path() . '/journals/pdf/'.$request->volume.'/', $pdf_name);
                $journal->pdf = $pdf_name;
            }

            $journal->type = $request->type;
            $journal->authors_ids = json_encode($request->authors_ids);
            $journal->volume = $request->volume;
            $journalSaved = $journal->save();
            
            $allAuthors = [];
            for($i=0;$i<count($request['authors_ids']);$i++){
                $allAuthors[] = [
                    'journal_id' => $journal->id,
                    'author_id' => $request['authors_ids'][$i]
                ];
            }   
            $insertAuthors = DB::table('journal_author_link')->insert($allAuthors);
        }catch(\Exception $e){
            DB::rollback();
            echo $e->getMessage();
            return redirect()->route('editor.create-journal')->with('error', 'Something went worng!');
        }

        DB::commit();

        if($journalSaved) {
            return redirect()->route('editor.create-journal')
                ->with('success', 'Article saved successfully.');
        } else {
            return redirect()->route('editor.create-journal')->with('error', 'Something went worng!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $journal = Journal::findOrFail($id);        
        $authors = SubmissionAuthor::all();
        return view('editor.journal.view', compact(['journal', 'authors']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journal = Journal::findOrFail($id);    
        $authors = SubmissionAuthor::all();
        $volumes = DB::table('volumes')->get();
        $types = DB::table('submission_types')->get();
        return view('editor.journal.edit', compact(['journal', 'authors','volumes','types']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'authors_ids' => 'required',
            'volume' => 'required',
            'type' => 'required'
        ]);
        // return $request->all();
        $journal = Journal::findOrFail($id); 
        $journal->name = $request->name;

        $journal_sname= str_replace(array("'", "\"", "&quot;"), "", $journal->name );
        $journal_name = htmlspecialchars(preg_replace('/\s+/', '-', $journal_sname));
        // dd($journal_name);

        $pdf = $request->file('pdf');
        if (isset($pdf)) {
            $pdf_name = $journal_name . '-' . time() . '.' . $pdf->getClientOriginalExtension();
            //for image unlink
            if(!empty($journal->pdf)) {
                if (file_exists(public_path('/journals/pdf/'.$request->volume.'/'. $journal->pdf))) {
                    unlink(public_path('/journals/pdf/'.$request->volume.'/'. $journal->pdf));
                }
            }
            $pdf->move(public_path() . '/journals/pdf/'.$request->volume.'/', $pdf_name);
            $journal->pdf = $pdf_name;
        }

        $journal->type = $request->type;
        $journal->authors_ids = json_encode($request->authors_ids);
        $journal->volume = $request->volume;
        if ($journal->update()) {
            return redirect()->route('editor.edit-journal', $id)
                ->with('success', 'Article updated successfully.');
        } else {
            return redirect()->route('editor.edit-journal', $id)->with('error', 'Something went worng!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        if(!empty($journal->pdf)) {
            if (file_exists(public_path('/journals/pdf/'.$journal->volume.'/'. $journal->pdf))) {
                unlink(public_path('/journals/pdf/'.$journal->volume.'/'. $journal->pdf));
            }
        }
        $journal->delete();

        return redirect()->route('editor.journals')->with('success', 'Article rmoved successfully!');
    }

    public function archive(){
        $allVolumes  = DB::table('volumes')
                     ->orderBy('id','DESC')
                     ->get();
                    
        return view('archive',['allVolumes'=>$allVolumes]);                   
    }
    
    public function journalsInVolume($id){
        
        $volumeDetails = DB::table('volumes')->where('id',$id)->first();

        $allJournals = DB::table('journals')
                     ->select('journals.id as journalId','journals.Name as journalName','submission_types.name as typeName','volumes.name as volumeName')   
                     ->join('submission_types','submission_types.id','journals.type')
                     ->join('volumes','volumes.id','journals.volume')
                     ->where('journals.volume',$id)
                //  ->join('journal_author_link','journal_author_link.journal_id','journals.id')
                //  ->join('submission_authors','journal_author_link.author_id','submission_authors.id')
                    ->orderBy('journalId','ASC')
                     ->get();
                    // dd($allJournals);

        if(count($allJournals) > 0){
            $totalJournal = count($allJournals);   
        }else{
            $totalJournal = 0;
        }
       

        $perPageContant = 5;

        $arrIndex = 0;        

        $journalAuthors = DB::table('journal_author_link')   
                        ->join('article_authors','journal_author_link.author_id','article_authors.id')
                        ->orderBy('journal_author_link.id','ASC')
                        ->get();
                // dd($journalAuthors);

        $journalDetails=[];
        

        for ($i=0; $i < count($allJournals) ; $i++) { 
            // $journalDetails[$i]['volumeName'] = $allJournals[$i]->volumeName;
            $journalDetails[$i]['journalName'] = $allJournals[$i]->journalName;
            $journalDetails[$i]['journalId'] = $allJournals[$i]->journalId;
            $journalDetails[$i]['typeName'] = $allJournals[$i]->typeName;
            for ($j=0; $j < count($journalAuthors); $j++) { 
                if($allJournals[$i]->journalId == $journalAuthors[$j]->journal_id){
                        $journalDetails[$i]['journalAuthors'][]=$journalAuthors[$j]->name;
                }
            }
        }

        $journalDetails = array_chunk($journalDetails,$perPageContant);

        return view('journalsInVolumeView',['journalDetails'=>$journalDetails,
                    'volumeDetails'=>$volumeDetails,'totalJournal'=>$totalJournal,
                    'perPageContant'=>$perPageContant,'arrIndex'=>$arrIndex]);    
    }

    public function journalsInVolumePage($volId,$pageNo){
        

        $volumeDetails = DB::table('volumes')->where('id',$volId)->first();

        $allJournals = DB::table('journals')
                     ->select('journals.id as journalId','journals.Name as journalName','submission_types.name as typeName','volumes.name as volumeName')   
                     ->join('submission_types','submission_types.id','journals.type')
                     ->join('volumes','volumes.id','journals.volume')
                     ->where('journals.volume',$volId)
                //  ->join('journal_author_link','journal_author_link.journal_id','journals.id')
                //  ->join('submission_authors','journal_author_link.author_id','submission_authors.id')
                     ->get();
                    // dd($allJournals);

        $totalJournal = count($allJournals);   
        
        $perPageContant = 5;

        $arrIndex = $pageNo-1;

        $journalAuthors = DB::table('article_authors')   
                        ->join('journal_author_link','article_authors.id','journal_author_link.author_id')
                        ->get();
                // dd($journalAuthors);

        $journalDetails=[];
        

        for ($i=0; $i < count($allJournals) ; $i++) { 
            // $journalDetails[$i]['volumeName'] = $allJournals[$i]->volumeName;
            $journalDetails[$i]['journalName'] = $allJournals[$i]->journalName;
            $journalDetails[$i]['journalId'] = $allJournals[$i]->journalId;
            $journalDetails[$i]['typeName'] = $allJournals[$i]->typeName;
            for ($j=0; $j < count($journalAuthors); $j++) { 
                if($allJournals[$i]->journalId == $journalAuthors[$j]->journal_id){
                        $journalDetails[$i]['journalAuthors'][]=$journalAuthors[$j]->name;
                }
            }
        }

        $journalDetails = array_chunk($journalDetails,$perPageContant);

        return view('journalsInVolumeView',['journalDetails'=>$journalDetails,
                    'volumeDetails'=>$volumeDetails,'totalJournal'=>$totalJournal,
                    'perPageContant'=>$perPageContant,'arrIndex'=>$arrIndex]);  
    }
}

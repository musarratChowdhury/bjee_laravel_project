<?php

namespace App\Http\Controllers;

use App\Journal;
use App\Models\SubmissionAuthor;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class volumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volumes = DB::table('volumes')
                 ->orderBy('id','DESC')
                 ->get();
        return view('editor.volume.index', compact('volumes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = SubmissionAuthor::all();
        return view('editor.volume.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'name' => 'required',
            // 'authors_ids' => 'required',
            // 'volume' => 'required',
            // 'type' => 'required',
            // 'pdf' => 'required|mimes:pdf|max:40400'
        ]);

        $chkDuplicate = DB::table('volumes')
                      ->where('name',$request['name'])
                      ->first();
               
        if($chkDuplicate){
            return redirect()->back()->with('error', 'This volume was created before!');
        }

        $saveData = DB::table('volumes')->insert([
            'name' => $request['name']
        ]);

        if($saveData){
            return redirect()->route('editor.volumes')
            ->with('success', 'Volume saved successfully.');
        }else{
            return redirect()->back()
            ->with('error', 'Something went worng!');
        }

       
        // $journal = new Journal;
        // $journal->name = $request->name;

        // $journal_sname= str_replace(array("", "\"", "&quot;"), "", $journal->name );
        // $journal_name = htmlspecialchars(preg_replace('/\s+/', '-', $journal_sname));
       

        // $pdf = $request->file('pdf');
        // if (isset($pdf)) {
        //     $pdf_name = $journal_name . '-' . time() . '.' . $pdf->getClientOriginalExtension();
        //     $pdf->move(public_path() . '/journals/pdf/'.$request->volume.'/', $pdf_name);
        //     $journal->pdf = $pdf_name;
        // }

        // $journal->type = $request->type;
        // $journal->authors_ids = json_encode($request->authors_ids);
        // $journal->volume = $request->volume;
        // if ($journal->save()) {
        //     return redirect()->route('editor.create-journal')
        //         ->with('success', 'Journal saved successfully.');
        // } else {
        //     return redirect()->route('editor.create-journal')->with('error', 'Something went worng!');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$journal = Journal::findOrFail($id);        
        $names = DB::table('volumes')->find($id);
        return view('editor.volume.show', compact('names'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $names = DB::table('volumes')->find($id);
        return view('editor.volume.edit', compact('names'));
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
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            // 'authors_ids' => 'required',
            // 'volume' => 'required',
            // 'type' => 'required',
            // 'pdf' => 'required|mimes:pdf|max:40400'
        ]);

        $chkDuplicate = DB::table('volumes')
                      ->where('name',$request['name'])
                      ->first();
               
        if($chkDuplicate){
            return redirect()->back()->with('error', 'This volume was created before!');
        }
       

        $saveData= DB::table('volumes')
        ->where('id', $id)
        ->update(['name' => $request['name']]);
       

        if($saveData){
            return redirect()->route('editor.volumes')->with('success','Updated successfully');
           
        }else{
            return redirect()->back()->with('error', 'Something went worng!');
            
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
        $volume = DB::table('volumes')->where('id',$id)->delete();
        
        

        return redirect()->back()->with('success','successfully deleted');
    }
}

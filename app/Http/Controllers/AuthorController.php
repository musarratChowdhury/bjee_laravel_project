<?php

namespace App\Http\Controllers;

use App\Helpers\ProcessFile;
use App\Models\Submission;
use App\Models\SubmissionFile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		return view('author.index',
			[
				'submissions' => Submission::where([
					['userid', auth()->user()->id],
				])->with('file')->orderBy('id', 'desc')->get(),
			]
		);
	}

	public function modMessage($submissionId){
		$journal_info = DB::table('submissions')
					  ->select('title','modif_start','modif_end')		
					  ->where('submissions.id',$submissionId)
					  ->first();	
		$modMessReviewer = DB::table('submission_reviewers')
						 ->join('users','users.id','submission_reviewers.reviewer_id')
						 ->where('submission_reviewers.submission_id',$submissionId)
						 ->where('submission_reviewers.accepted',1)
						 ->get();

		$modMess = DB::table('submission_reviews')
				 ->where('submission_reviews.submission_id',$submissionId)
				 ->where('submission_reviews.broad_cast',1)
				 ->get();		
				 
		return view('author.modification',[
			'journal_info'=>$journal_info,'modMessReviewer'=>$modMessReviewer,'modMess'=>$modMess
		]);		 
		// dd($journal_info);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function startSubmission()
	{
		return view('author.submissions');
	}


	/**
	 * Create a Submission for user
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function createSubmission(Request $request)
	{
	    $curr_date = $current = Carbon::now();
	    $curr_year = Carbon::parse($curr_date)->format('Y');
	    $create_journal = '';
	    
	    
	    DB::beginTransaction();
        
        try{
            
	       // $create_journal = DB::table('submissions')
	       //                 ->insert([
	       //                     'userid'=>Auth::user()->id,
	       //                     'journal_code'=>$journal_code
	       //                 ]);
	       $create_journal = Submission::create([
	            'userid'=>Auth::user()->id
	           ]);
	       //dd($create_journal->id);
	       
	       
	       // dd($create_journal);
	       //echo 'Journal Id is---------------->'.$create_journal->id;  
	      
            
        }catch(\Exception $e){
            DB::rollback();
            echo $e->getMessage();
            dd('Query Error..............');
        } 
        
        DB::commit();
        
        DB::beginTransaction();
        
        try{
            $journal_code = 'BJEE-'.$curr_year.'-'.str_pad($create_journal->id, '4', '0', STR_PAD_LEFT);
            $exist_journal = DB::table('submissions')
                           ->where('id',$create_journal->id)
                           ->update([
                                'journal_code'=> $journal_code
                            ]);
            
        }catch(\Exception $e){
            DB::rollback();
            echo $e->getMessage();
            dd('Query Error..............');
        }   
        
        DB::commit();
        
       //   $id = DB::table('submissions')->select('id')->orderBy('id','desc')->first();
	   //   $journal_code = 'BJEE-'.$curr_year.'-'.str_pad($id->id, '4', '0', STR_PAD_LEFT);
        return redirect()->route('submission.step1', ['submissionId' => $create_journal->id]); 
	   
        
	   // dd($journal_code);
	   // {{ 'BJEE-' . \Carbon\Carbon::parse($submission->created_at)->format('Y') . '-' . str_pad($submission->id, '4', '0', STR_PAD_LEFT) }}
       // return redirect()->route('submission.step1', ['submissionId' => Submission::create(['userid' => Auth::user()->id])->id]);
	}


	public function deleteSubmission($submissionId)
	{
		$submission = Submission::find($submissionId);
		$savedFiles = $submission->files;

		if (is_array($submission->files) && count($submission->files) > 0) {
			foreach ($savedFiles as $savedFile) {
				ProcessFile::deleteSubmissionFile($submissionId, $savedFile->id, $savedFile->path);
			}
			SubmissionFile::where('submission_id', $submissionId)->delete();
		}

		$submission->delete();

		return redirect()->route('author')->with(['success' => 'Submission is Deleted']);
	}

	/**
	 * Output all Submitted files with Side-Numbers
	 */
	public function outputSubmissions($submissionId)
	{
	   
		return ProcessFile::getNumberedFile($submissionId);
	}

	/**
	 *  View all reviews for submission
	 */
	public function viewReviews($submissionId)
	{

		return view(
			'author.reviews',
			[
				'submission' => Submission::find($submissionId),
			]
		);
	}
}

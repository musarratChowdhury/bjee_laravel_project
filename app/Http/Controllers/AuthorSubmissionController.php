<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\ProcessFile;
use App\Helpers\SubmissionStepChecks;
use App\Http\Requests\SubmissionStep1Validate;
use App\Http\Requests\SubmissionStep2Validate;
use App\Http\Requests\SubmissionStep3Validate;
use App\Http\Requests\SubmissionStep4Validate;
use App\Http\Requests\SubmissionStep5Validate;
use App\Http\Requests\SubmissionStep6Validate;
use App\Models\SubmissionFile;
use App\Models\Submission;
use App\Models\Options\Keyword;
use App\Models\SubmissionAuthor;
use App\Models\SubmissionKeyword;
use App\Models\SubmissionSpecialIssue;
use App\Models\SubmissionType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthorSubmissionController extends Controller
{

	public function step1($submissionId)
	{
		$submission = Submission::find($submissionId);
		return view('author.submission.step1', [
			'submission' => $submission,
			'types' => SubmissionType::all(),
// 			'specialIssues' => SubmissionSpecialIssue::all(),
			'msg' => [] ?? SubmissionStepChecks::message($submission, [1]) ?? []
		]);
	}

	public function step1Post(SubmissionStep1Validate $request, $submissionId)
	{
// 		dd($request->all());

		Submission::where([
			['id', $submissionId],
		])->update(
			[
				'title' => $request->title,
				'type' => $request->type,
				'running_head' => $request->runninghead,
				'Abstract' => $request->abstract,
				'number_of_words' => $request->number_of_words,
				'special_issue' => $request->special_issue,
				'sp_issue_description' => $request->spIssueDesc
			]
		);

        if(isset($request['conti'])){
	         return redirect()->route('submission.step3', $submissionId)->with([
			'success' => '<strong>Submission Updated.</strong>'
		]);
	    }
		return redirect()->route('submission.step1', $submissionId)->with([
			'success' => '<strong>Submission Updated.</strong>'
		]);
	}


	public function step2($submissionId)
	{
		$submission = Submission::find($submissionId);
		return view('author.submission.step2', [
			'submission' => $submission,
			'files' => SubmissionFile::where('userid', Auth::user()->id)->where('submission_id', $submissionId)->get(),
			'msg' => [] ?? SubmissionStepChecks::message($submission, [2]) ?? []
		]);
	}

    public function step2Upload(SubmissionStep2Validate $request, $submissionId)
	{
		$chk_pre_file = DB::table('submission_files')
					  ->where('submission_id',$submissionId)
					  ->where('userid',Auth::user()->id)	
					  ->first();
		
		if($chk_pre_file){
			
			if(file_exists( storage_path('app/') . $chk_pre_file->pdf)){
				unlink( storage_path('app/') . $chk_pre_file->pdf);
				echo 'Inside unlink pdf';
			}
			if(file_exists( storage_path('app/') . $chk_pre_file->word)){
				unlink( storage_path('app/') . $chk_pre_file->word);
				echo 'Inside unlink word';
			}

			$chk_pre_file = DB::table('submission_files')
					  ->where('submission_id',$submissionId)
					  ->where('userid',Auth::user()->id)	
					  ->delete();
		}	
		
		$fullPath =  'submissions/' . date('Y/m/d/') . $submissionId . '/' .   Auth::user()->id;
		$time = Carbon::now()->toDateTimeString();
		$data[] = [
			'submission_id' => $submissionId,
			'userid' =>  Auth::user()->id,
			'pdf' => $request->pdf->store($fullPath), // upload and get the unique name with fullpath
			'word' => $request->word->store($fullPath), // upload and get the unique name with fullpath		
			'created_at' => $time,
			'updated_at' => $time,
		];

		if (!isset($data)) {
			return redirect()->route('submission.step2', $submissionId)->with([
				'warning' => 'You didn\'t uploaded any file(s).'
			]);
		}

		$subFiles = SubmissionFile::insert($data);
		ProcessFile::deleteNumberedFile($submissionId);
		try{
			ProcessFile::createNumberedPDFAuto($submissionId);
		}catch(\Exception $e){
			$delWordPdf = DB::table('submission_files')
						->where('submission_id',$submissionId)  
						->where('userid',Auth::user()->id)
						->first();

			if(file_exists( storage_path('app/') . $delWordPdf->pdf)){
				unlink( storage_path('app/') . $delWordPdf->pdf);
			}
			if(file_exists( storage_path('app/') . $delWordPdf->word)){
				unlink( storage_path('app/') . $delWordPdf->word);
			}

			if($delWordPdf){
				$delWordPdf = DB::table('submission_files')
						->where('submission_id',$submissionId)  
						->where('userid',Auth::user()->id)
						->delete();
			}
			
			return redirect()->route('submission.step2', $submissionId)->with([
				'warning' => 'Files are Not Uploaded. Please Create a New PDF and Upload It Again.'
			]);
		}
		

        if(isset($request['conti'])){
	         return redirect()->route('submission.step4', $submissionId)->with([
			'success' => '<strong>Your files are uploaded.</strong>'
		]);
	    }
		return redirect()->route('submission.step2', $submissionId)->with([
			'success' => '<strong>Your files are uploaded.</strong>'
		]);
	}

	public function step2UploadOld(Request $request, $submissionId)
	{

		$supportedExtentions = [
			'pdf',
			'doc',
			'docx',
			'png',
			'jpg',
			'jpeg',
		];

		/**
		 * File Validation - Start
		 */
		$key = 0;
		foreach ($request->doc as $arr) {
			if (
				isset($request->doc[$key]['name']) &&
				$request->doc[$key]['name']->getClientOriginalName() !== NULL &&
				!in_array($request->doc[$key]['name']->getClientOriginalExtension(), $supportedExtentions)
			) {
				return redirect()->route('submission.step2', $submissionId)->with([
					'warning' => 'File Format is not supported.'
				]);
			}
			$key++;
		}

		/**
		 * File Upload to server and save names to database
		 */
		$fullPath =  'submissions/' . date('Y/m/d/') . $submissionId . '/' .   Auth::user()->id;
		$file_order = 0;
		$key = $file_order;
		$time = Carbon::now()->toDateTimeString();
		foreach ($request->doc as $arr) {
			++$file_order;
			if (
				isset($request->doc[$key]['name']) &&
				$request->doc[$key]['name']->getClientOriginalName() !== NULL
			) {
				$data[] = [
					'submissionid' => $submissionId,
					'userid' =>  Auth::user()->id,
					'file_order' => $file_order,
					'file_designation' => $arr['designation'] ?? 0,
					'path' => $request->doc[$key]['name']->store("$fullPath"), // upload and get the unique name with fullpath
					'extention' => $request->doc[$key]['name']->getClientOriginalExtension(),
					'original_name' => $request->doc[$key]['name']->getClientOriginalName(),
					'created_at' => $time,
					'updated_at' => $time,
				];
			}
			$key++;
		}

		if (!isset($data)) {
			return redirect()->route('submission.step2', $submissionId)->with([
				'warning' => 'You didn\'t uploaded any file(s).'
			]);
		}

		SubmissionFile::insert($data);
		ProcessFile::deleteNumberedFile($submissionId);

		return redirect()->route('submission.step2', $submissionId)->with([
			'success' => 'Your file(s) are uploaded.'
		]);
	}

	public function step2DownloadWord($submissionId, $fileId)
	{
		$file = SubmissionFile::where([
			['id', $fileId],
			['submission_id', $submissionId]
		])->first();

		if (Storage::disk('local')->exists($file->word)) {
			return Storage::download($file->word);
		}

		return view(404)->with(['warning' => 'File not Found.']);
	}

	public function step2DownloadPDF($submissionId, $fileId)
	{
		$file = SubmissionFile::where([
			['id', $fileId],
			['submission_id', $submissionId]
		])->first();

		if (Storage::disk('local')->exists($file->pdf)) {
			return Storage::download($file->pdf);
		}

		return view(404)->with(['warning' => 'File not Found.']);
	}

	public function step2DeleteFile($submissionId, $fileId)
	{
		$files = SubmissionFile::find($fileId);
		ProcessFile::deleteSubmissionFile($submissionId, $fileId, $files->path);
		$files->delete();

		return redirect()->route('submission.step2', $submissionId)->with([
			'success' => 'Your file is deleted.'
		]);
	}

	public function step3($submissionId)
	{
		$submission = Submission::find($submissionId);

		return view('author.submission.step3', [
			'submission' => $submission,
			'keywords' => Keyword::all(),
			'submission_keywords' => SubmissionKeyword::where('submission_id', $submissionId)->get(),
			'msg' => [] ?? SubmissionStepChecks::message($submission, [3]) ?? []
		]);
	}


	public function step3DeleteKeyWord(Request $request, $submissionId)
	{			
	   // return  $submissionId;
		if(SubmissionKeyword::where('submission_id',$submissionId)->where('keyword_id',$request->keyword_id)->delete()) {
			return response()->json(['deleted' => 1], 200);
		} else {
		    return response()->json(false, 400);
        }

		// return redirect()->route('submission.step3', $submissionId)->with([
		// 	'success' => 'Keyword Removed.'
		// ]);
	}

// 	public function step3Post(SubmissionStep3Validate $request, $submissionId)
	public function step3Post(SubmissionStep3Validate $request)
	{
        // dd($request->all());
		$retData = array();
		$newKeyword = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $request['keyword'])));
		$upperKeyword = strtoupper($newKeyword);
		
		$chkUpKeyword = DB::table('keywords')->where('up_name',$upperKeyword)->first();
		// dd($request['submissionId']);
		$chkDuplicateEntry = '';
		if($chkUpKeyword){
			$chkDuplicateEntry = DB::table('submission_keywords')
						   ->where('submission_id',$request['submissionId'])	
						   ->where('keyword_id',$chkUpKeyword->id)
						   ->first();
		}
		
		// dd($chkDuplicateEntry);				    
		
		$keywordId = '';
		$status = '';

		$time = Carbon::now()->toDateTimeString();


		if(!$chkUpKeyword){
			// echo "This is the new One";
			$keyword =  Keyword::firstOrCreate(['name' => $newKeyword,'up_name' => $upperKeyword]);
			SubmissionKeyword::firstOrCreate([
				'submission_id' => $request['submissionId'],
				'keyword_id' => $keyword->id,
				'created_at' => $time,
				'updated_at' => $time,
			]);
			$keywordId = $keyword->id;
			$status = 'newKeyword';
		}elseif($chkDuplicateEntry){
			$keywordId = $chkUpKeyword->id;
			$status = 'duplicateEntry';
		}else{
			// echo "Duplicate result";
			$keywordId = $chkUpKeyword->id;
			SubmissionKeyword::firstOrCreate([
				'submission_id' => $request['submissionId'],
				'keyword_id' => $chkUpKeyword->id,
				'created_at' => $time,
				'updated_at' => $time,
			]);
			$status = 'duplicateKeyword';
		}

		return response()->json([
			 "id" => $keywordId,
			 "status" => $status
		    ]);

		// return response()->json(['success' => 'true'], 200);
	}

	public function step4($submissionId)
	{
		$submission = Submission::find($submissionId);
		return view('author.submission.step4', [
			'submission' => $submission,
			'main_author' => $submission,
			'authors' => SubmissionAuthor::where('submission_id', $submissionId)->get(),
			'msg' => [] ?? SubmissionStepChecks::message($submission, [4]) ?? []
		]);
	}

	public function step4AuthorDelete(Request $request, $submissionId)
	{

		SubmissionAuthor::find($request->author_id)->delete();
		
		return response()->json(['success' => true], 200);

	}

	public function step4Post(SubmissionStep4Validate $request, $submissionId)
	{

		// return response()->json(['success' => 0], 200);

		$author = new SubmissionAuthor();
 		$author->name = $request->name;
 		$author->email = $request->email;
 		$author->institution = $request->institution;
		$author->submission_id = $submissionId;

		if($author->save())
			return response()->json(['id' => $author->id], 200);
		
		return response()->json(['success' => 0], 400);
		 
		if ($request->author_email == null) {
			return redirect()->back()->with([
				'warning' => 'No author added Updated.'
			]);
		}

		$author = new  SubmissionAuthor();
		$author->submission_id = $submissionId;
		$author->email = $request->author_email;
		$author->save();
		
		if(isset($request['conti'])){
	         return redirect()->route('submission.step5', $submissionId)->with([
			'success' => '<strong>Submission Updated.</strong>'
		]);
	    }

		return redirect()->route('submission.step4', $submissionId)->with([
			'success' => '<strong>Submission Updated.</strong>'
		]);
	}

	public function step5($submissionId)
	{
		$submission = Submission::find($submissionId);
		return view('author.submission.step5', [
			'submission' => $submission,
			'msg' => [] ?? SubmissionStepChecks::message($submission, [5]) ?? []

		]);
	}

	public function step5Post(Request $request, $submissionId)
	{
		// dd($request->all());

		$rules = [
			'cover_letter' => 'required|string',
			// 'number_of_figures' => 'required|numeric',
			// 'number_of_color_figures' => 'required|numeric',
			// 'number_of_tables' => 'required|numeric',
 			//'number_of_words' => 'required|numeric',
			'funding' => 'required',
			'manuscript_previously' => 'required',
			// 'data_set_associated' => 'required',
			'confirm_recommendation' => 'required',
			'conflict_of_interest' => 'required',
			// 'human_subjects' => 'required',
		];

		$msg = [
			// 'number_of_figures.required' => 'Number of Figures  is a required field.',
			// 'number_of_figures.numeric' => 'Number of Figures is a required field.',

			// 'number_of_color_figures.required' => 'Number of Color Figures is a required field.',
			// 'number_of_color_figures.numeric' => 'Number of Color Figures is a required field.',

			// 'number_of_tables.required' => 'Number of Tables is a required field.',
			// 'number_of_tables.numeric' => 'Number of Tables is a required field.',

// 			'number_of_words.required' => 'Number of Words is a required field.',
// 			'number_of_words.numeric' => 'Number of Words is a required field.',

			'cover_letter.required' => 'Cover letter is a required field.',
			'cover_letter.string' => 'Cover letter is a required field.',

			'funding.required' => 'Funding is a required field.',
			// 'data_set_associated.required' => 'Data Policy is a required field.',
			'confirm_recommendation.required' => 'Accepted Manuscript Disclaimer is a required field.',
			'conflict_of_interest.required' => 'Conflict of Interest is a required field.',
			'manuscript_previously.required' => 'Has this manuscript been submitted previously? is a required field.',
			// 'human_subjects.required' => 'Human Subjects Approval is a required field.',
		];

		// if ($request->conflict == 1) {
		// 	$rules['conflict_of_interest_yes'] = 'required';
		// 	$msg['conflict_of_interest_yes.required'] = 'If yes, Please State Conflict of Interest(s) is a required field.';
		// }

		// if ($request->data_set_associated == 1) {
		// 	$rules['data_set_associated_yes'] = 'required';
		// 	$msg['data_set_associated_yes.required'] = 'If yes, Please State Dataset is a required field.';
		// }
		// if ($request->human_subjects == 'c') {
		// 	$rules['human_subjects_details_c'] = 'required';
		// 	$msg['human_subjects_details_c.required'] = 'If you answered C above, please detail how you protected your study participants is a required field.';
		// }
		// if ($request->human_subjects == 'd') {
		// 	$rules['human_subjects_details_d'] = 'required';
		// 	$msg['human_subjects_details_d.required'] = 'If you answered D above, please detail how you protected your study participants is a required field.';
		// }


		Submission::where([
			['id', $submissionId],
		])->update(
			[
				'cover_letter' => $request->cover_letter ?? null,
				'funding' => $request->funding ?? null,
				'funding_description' => $request->fundingDesc ?? null,

				// 'number_of_figures' => $request->number_of_figures ?? null,
				// 'number_of_color_figures' => $request->number_of_color_figures ?? null,
				// 'number_of_tables' => $request->number_of_tables ?? null,

				// 'number_of_words' => $request->number_of_words ?? null,

				'manuscript_previously' => $request->manuscript_previously ?? null,

				// 'color_reproduction' => $request->color_reproduction ?? null,

				'conflict_of_interest' => $request->conflict_of_interest ?? null,
				'conflict_of_interest_yes' => $request->conflict_of_interest_yes ?? null,

				// 'data_set_associated' => $request->data_set_associated ?? null,
				// 'data_set_associated_yes' => $request->data_set_associated_yes ?? null,

				// 'human_subjects' => $request->human_subjects ?? null,
				// 'human_subjects_details_c' => $request->human_subjects_details_c ?? null,
				// 'human_subjects_details_d' => $request->human_subjects_details_d ?? null,

				'confirm_recommendation' => $request->confirm_recommendation ?? null,

			]
		);

		$validator = Validator::make($request->all(), $rules, $msg);

		if ($validator->fails()) {
			// dd($validator->errors());
			return redirect()->route('submission.step5', $submissionId)->with([
				'danger' => 'Completed the form properly.',
				'errors' => $validator->errors(),
			]);
		}
		
		if(isset($request['conti'])){
	         return redirect()->route('submission.step6', $submissionId)->with([
			'success' => '<strong>Submission Updated.</strong>'
		]);
	    }

		return redirect()->route('submission.step5', $submissionId)->with([
			'success' => '<strong>Submission Updated..</strong>'
		]);
	}

	public function step6($submissionId)
	{

		$submission = Submission::find($submissionId);

		return view('author.submission.step6', [
			'submission' => $submission,
			'authors' => SubmissionAuthor::where('submission_id', $submissionId)->get(),
			'keywords' =>  SubmissionKeyword::where('submission_id', $submission->id)->get(),
			'special_issue' => $submission->special_issue == null ? '-' : SubmissionSpecialIssue::find($submission->special_issue)->name,
			'msg' => SubmissionStepChecks::message($submission) ?? [],
			'current_status' => $submission->current_status
		]);
	}
	
	public function viewPdfForAuthor($submissionId, $fileId)
    {
        return ProcessFile::showNumberedFile($submissionId, $fileId) ?? 'No FIle Found';
    }

	public function step6Post(SubmissionStep6Validate $request, $submissionId)
	{
    //   dd($request->all());
		if (count(SubmissionStepChecks::message(Submission::find($submissionId))) > 0)
			return redirect()->back()->with(['danger' => 'Your submission is incomplete.']);

		$time = Carbon::now()->toDateTimeString();
		$success = 'Your submission is saved';
		
        //======================================================
		DB::beginTransaction();
        try{
    		Submission::where('id', $submissionId)
    			->where('userid', Auth::user()->id)
    			->update(
    				['current_status' => $request->status],
    				['review_start_date' =>  $time]
    			);
        }catch(\Exception $e){
            DB::rollback();
            echo $e->getMessage();
            dd('Error');
        }
        DB::commit();
        // ======================================================

		if ($request->status === '5') {
			$success .= ' and submitted for review';
		}
		
		if ($request->status === '6') {
			$success .= ', Modified and Submitted To Editor';
		}

		return redirect()->route('author')->with(['success' => $success . '.']);
	}
}

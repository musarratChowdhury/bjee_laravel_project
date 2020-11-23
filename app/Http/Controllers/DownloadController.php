<?php

namespace App\Http\Controllers;

use App\Helpers\ProcessFile;
use App\Models\Review;
use App\Models\Reviews\SubmissionReview;
use App\Models\SubmissionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class DownloadController extends Controller
{

	public function downloadReviewFile($submission_review_id)
	{
		$file = SubmissionReview::find($submission_review_id)->file;
		if ($file === null)
			return view(404)->with(['warning' => 'File not Found.']);
		return Storage::download($file);
	}

	public function downloadWord($submissionId, $fileId)
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

	public function downloadPdf($submissionId, $fileId)
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

    public function downloadMyReview($submissionId,$reviewerId,$status)
	{
		$review = DB::table('submission_reviews')
				->where('submission_id',$submissionId)
				->where('reviewer_id',$reviewerId)
				->first();
		
		// dd($review->file);
		if($status == 'toAuthor'){
			if (Storage::disk('local')->exists($review->file_to_author)) {
				return Storage::download($review->file_to_author);
			}
		}else{
			if (Storage::disk('local')->exists($review->file_to_editor)) {
				return Storage::download($review->file_to_editor);
			}
		}
		

		return view(404)->with(['warning' => 'File not Found.']);
	}

	public function downloadNumbered($submissionId)
	{
		$file = ProcessFile::numberedFileLocation($submissionId);
		return response()->download($file);
	}
}

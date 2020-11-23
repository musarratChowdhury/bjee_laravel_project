<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function fileDesignation($key = null)
    {

        $arr = [
            1 => 'Title Page (not for review)',
            2 => 'Main Document',
            3 => 'Figure',
            4 => 'Table',
            5 => 'Supplemental File',
            6 => 'File not for review',
        ];

        if ($key !== null) {
            return $arr[$key] ?? ' -- ';
        }

        return $arr;
    }

    public static function submittedForReview($submissionId)
    {
        $numberOfOnGoingReviews = \App\Models\Review::where('submission_id', $submissionId)
            ->where('editor_verdict', '=', 0)
            ->count();

        if ($numberOfOnGoingReviews == 0) {
            $submitForReview = new \App\Models\Review();
            $submitForReview->submission_id = $submissionId;
            $submitForReview->save();

            return true;
        }

        return false;
    }

    /**
     * Is this Submission is open for review (again).
     *
     * @return \Illuminate\Http\Response
     */
    public static function openForReview($submissionId)
    {
        // dd($submissionId);

        $openReviewCycle = \App\Models\Reviews\ReviewCycle::where('submission_id', $submissionId)->where('editor_verdict', 0)->where('end_date', null)->first();
        // dd($openReviewCycle);
        if ($openReviewCycle !== null) {
            $submissionReview = \App\Models\Reviews\SubmissionReview::where('reviewer_id', Auth::user()->id)->where('submission_id', $submissionId)->where('review_cycle_id', $openReviewCycle->id)->first();
            // return $submissionReview;
            if ($submissionReview === null) {
                return $openReviewCycle->id;
            }

            if ($submissionReview->status === 0) {
                return $openReviewCycle->id;
            }

        }

        return false;
    }

    public static function myCurrentReview($submissionId)
    {
        // $openReviewCycle = \App\Models\Reviews\ReviewCycle::where('submission_id', $submissionId)->where('editor_verdict', 0)->where('end_date', null)->first();
        // if ($openReviewCycle !== null) {
        //     $submissionReview = \App\Models\Reviews\SubmissionReview::where('reviewer_id', Auth::user()->id)->where('submission_id', $submissionId)->where('review_cycle_id', $openReviewCycle->id)->first();
        //     if ($submissionReview !== null) {
        //         return $submissionReview;
        //     }
        // }
        // return false;

        $submissionReview = \App\Models\Reviews\SubmissionReview::where('reviewer_id', Auth::user()->id)->where('submission_id', $submissionId)->first();
        if($submissionReview){
            return $submissionReview;
        }
        return false;
    }

    public static function countSubmission($toCount = null)
    {
        $submissions = \App\Models\Submission::select('id');

		if ($toCount === null) {
            $submissions->where('current_status', 5);
		}
		
        if ($toCount === 'submitted') {
            $submissions->where('current_status', '>' , 0);
		}
		
		if ($toCount === 'ready to publish') {
			$submissions->where('current_status', 3);
        }

        if ($toCount === 'published') {
            $submissions->where('current_status', 3);
        }        

        if ($toCount === 'in review') {
            $submissions->where('current_status', 1);
        }

        if ($toCount === 'technical review') {
            $submissions->where('current_status', 4);
        }       

        return $submissions->count();

    }

    public function doNotCall()
    {
        // // Storage::deleteDirectory('submissions');
        // // return Storage::download("submissions/$fullPath/{$request->doc[$file_order]['name']->getClientOriginalName()}", 'rename-to-original.png');

    }
}

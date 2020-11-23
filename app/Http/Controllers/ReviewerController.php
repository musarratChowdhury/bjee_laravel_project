<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\ProcessFile;
use App\Http\Requests\submitReviewValidate;
use App\Models\Options\ReviewRating;
use App\Models\Reviews\SubmissionReview;
use App\Models\Submission;
use App\Models\SubmissionAuthor;
use App\Models\SubmissionKeyword;
use App\Models\SubmissionReviewer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewerController extends Controller
{

    /**
     * Display a listing of the submissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function submissions()
    {

        return view('reviewer.submissions',
            [
                'submissionToReview' => SubmissionReviewer::with('submission')
                                    ->where('reviewer_id', Auth::user()->id)
                                    ->where('accepted',1)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10),
            ]
        );

    }

    public function showSubmission($submissionId)
    {

        return view('reviewer.submissionDetails',
            [
                'submission' => Submission::find($submissionId),
                'authors' => SubmissionAuthor::where('submission_id', $submissionId)->get(),
                'keywords' => SubmissionKeyword::where('submission_id', $submissionId)->get(),
                'reviewer' => SubmissionReviewer::where('reviewer_id', Auth::user()->id)->where('submission_id', $submissionId)->first(),
                'reviews' => SubmissionReview::where('reviewer_id', Auth::user()->id)->where('submission_id', $submissionId)->orderBy('id', 'DESC')->get(),
            ]
        );
    }

    /**
     * Review a Submission.
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewSubmission($submissionId)
    {

        $isReviewed = SubmissionReviewer::where('reviewer_id', Auth::user()->id)->where('submission_id', $submissionId)
            ->first();

            

        if ($isReviewed->accepted === null) {
            return redirect()->route('reviewer.submissions')->with(['warning' => 'To review this submission; please accept review request.']);
        }

        if ($isReviewed->accepted === 0) {
            return redirect()->route('reviewer.submissions')->with(['warning' => 'You have rejected to review this submission.']);
        }

        // if (!Helper::openForReview($submissionId)) {
        //     return redirect()->route('reviewer.submissions')->with(['success' => 'You have reviewed this submission.']);
        // }

        return view(
            'reviewer.submit_review',
            [
                'ratings' => ReviewRating::get(),
                'reviewer' => $isReviewed,
                'submissionId' => $submissionId,
                'myReview' => Helper::myCurrentReview($submissionId) ?? null,
                'reviewerId' => Auth::user()->id,
            ]
        );
    }

   public function submitReview(submitReviewValidate $request, $submissionId)
    {
        dd($request->all());
		
		// Change the checking login - if a submission is open for reviewing
		
		// submission openForReview check - Start
		$openForReview = true ?? Helper::openForReview($submissionId);       

       if (!$openForReview) {
            return redirect()->route('reviewer.submissions')->with(['danger' => 'You are not allowed to reviewed this submission at this <time class=""></time>']);
        }
		// submission openForReview check - End
		
        if (Helper::myCurrentReview($submissionId)) {
            $review = Helper::myCurrentReview($submissionId);
        } else {
            $review = new SubmissionReview();
        }

        $review->review_cycle_id = $openForReview;
        $review->submission_id = $submissionId;
        $review->rating = $request->rating;
        $review->reviewer_id = Auth::user()->id;
        $review->comments_to_editor = $request->commentToEditor ?? '';
		$review->comments_to_author = $request->commentToAuthor ?? '';
		
		/**
		 * File upload : Start
		 */
        if ($request->file_to_editor !== null) {
            $review->file_to_editor = $request->file_to_editor->store("reviews/{$review->submission_id}/file_to_editor");
		}

		if ($request->file_to_author !== null) {
            $review->file_to_author = $request->file_to_author->store("reviews/{$review->submission_id}/file_to_author");
		}

		/**
		 * File upload : End
		 */

        if ($request->status == 1) {
            $review->status = 1;
            $submitted = [
                'success' => 'Your review is submitted.',
            ];
        }

        $review->save();

        return redirect()->route('reviewer.submissions', $review->submission_id)->with(
            $submitted ?? [
                'success' => 'Your review is saved as draft.',
            ]
        );
    }
    
    public function showMyReviews($submissionId)
    {
        return view('reviewer.reviewDetails',
            [
                'reviewer' => SubmissionReviewer::where('reviewer_id', Auth::user()->id)->where('submission_id', $submissionId)->first(),
                'reviews' => SubmissionReview::where('reviewer_id', Auth::user()->id)->where('submission_id', $submissionId)->orderBy('id', 'DESC')->get(),
                'submission' => Submission::find($submissionId),

            ]
        );
    }

    public function viewPdf($submissionId, $fileId)
    {
        return ProcessFile::showNumberedFile($submissionId, $fileId) ?? 'No FIle Found';
    }

    public function reviewDetails($reviewerId)
    {
        return view(
            'reviewer.reviewDetails',
            [
                'reviewer' => SubmissionReviewer::find($reviewerId),
            ]
        );
    }

    public function acceptedToReview($reviewerId,$submissionId)
    {
        // echo 'reviewerId-------------->'.$reviewerId;
        // echo 'submissionId------------>'.$submissionId;
        // dd('acceptedToReview---------------->');
        // dd($reviewerId);
        // Have to check reviwerId + paperId + lastDateOfReview  
        // $review = SubmissionReviewer::find($reviewerId);
        $review = SubmissionReviewer::where('reviewer_id',$reviewerId)
                                    ->where('submission_id',$submissionId);
        // $review->accepted = 1;
        // $review->accepted_time = Carbon::now();
        $review->update(['accepted'=>1,'accepted_time'=>Carbon::now()]);
        return redirect()->route('reviewer.submissions');
    }
    public function declineToReview($reviewerId,$submissionId)
    {
        echo 'reviewerId-------------->'.$reviewerId;
        echo 'submissionId------------>'.$submissionId;
        dd('acceptedToReview---------------->');
        // $review = SubmissionReviewer::find($reviewerId);
        $review = SubmissionReviewer::where('reviewer_id',$reviewerId)
                                    ->where('submission_id',$submissionId);
        // $review->accepted = 0;
        // $review->accepted_time = Carbon::now();
        // $review->update();
        $review->update(['accepted'=>0,'accepted_time'=>Carbon::now()]);
        return redirect()->route('reviewer.submissions');
    }
}

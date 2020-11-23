<?php

namespace App\Http\Controllers;

use App\Http\Requests\assignReviewerValidate;
use App\Models\Review;
use App\Models\Reviews\ReviewCycle;
use App\Models\Reviews\SubmissionReview;
use App\Models\Submission;
use App\Models\SubmissionAuthor;
use App\Models\SubmissionKeyword;
use App\Models\SubmissionReviewer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $submissions = Submission::with('file');

        return view('submissions.index',
            [
                'submissions' => $submissions->orderBy('id', 'desc')->paginate(10),
            ]
        );
    }


  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($submissionId)
    {
		$cycle = ReviewCycle::where('submission_id', $submissionId);

        return view('author.show',
            [
                'submission' => Submission::find($submissionId),
                'authors' => SubmissionAuthor::where('submission_id', $submissionId)->get(),
                'keywords' => SubmissionKeyword::where('submission_id', $submissionId)->get(),
				'num_of_cycle' => $cycle->count(),
				'review_cycles' => $cycle->get(),
				'reviews' => SubmissionReview::where('submission_id', $submissionId)->orderBy('id', 'desc')->get()->groupBy('review_cycle_id')->toArray(),

            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

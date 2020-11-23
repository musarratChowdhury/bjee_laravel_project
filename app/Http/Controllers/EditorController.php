<?php

namespace App\Http\Controllers;

use App\Helpers\ProcessFile;
use App\Http\Requests\assignReviewerValidate;
use App\Http\Requests\EditorCreateReviewerValidate;
use App\Mail\NotifyReviewer;
use App\Models\Options\Status;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EditorController extends Controller
{

    public function showfile($submissionId, $fileId)
    {
        return ProcessFile::getNumberedFile($submissionId) ?? 'No FIle Found';

    }

    public function submissions()
    {
        return view('editor.submissions',
            [
                'submissions' => Submission::with('file')->where('current_status',5)->orderBy('id', 'desc')->paginate(10),
            ]
        );
    }
    public function inReview()
    {
        return view('editor.inReview',
        [
            'submissions' => Submission::with('file')->where('current_status',1)->orderBy('id', 'desc')->paginate(10),
        ]
    );
    }
    public function technicalReview()
    {
        return view('editor.technicalReview',
        [
            'submissions' => Submission::with('file')->where('current_status',4)->orderBy('id', 'desc')->paginate(10),
        ]
    );
    }
    public function readyToPublish(){
        return view('editor.readyToPublish',
        [
            'submissions' => Submission::with('file')
                                        ->where('current_status',3)
                                        ->orWhere('current_status',6)
                                        ->orderBy('id', 'desc')
                                        ->paginate(10),
        ]
    );
    }

    public function reviewers()
    {
        return view('editor.reviewers', ['reviewers' => User::all()]);
    }

    public function addNewReviewer()
    {
        return view('editor.addNewUser');
    }

    public function checkReviews()
    {
        // $reviews =
        return view('editor.addNewUser');
    }

    public function saveNewReviewer(EditorCreateReviewerValidate $request)
    {

        // dd($request->all());
        $newUser = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'view_password' => $request->password
        ]);

        $newUser->assignRole('reviewer');
        // dd($newUser);
        return redirect()->route('editor.submissions')->with(['success' => $newUser->name . ' added as a reviewer and notified via email']);
    }

    public function showSubmission($submissionId)
    {
        $cycle = ReviewCycle::where('submission_id', $submissionId);

        return view('editor.showSubmissionDetails',
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

    public function checkSubmissionReviews($submissionId)
    {
        $cycle = ReviewCycle::where('submission_id', $submissionId);
        return view('editor.checkReviews',
            [
                'num_of_cycle' => $cycle->count(),
                'review_cycles' => $cycle->get(),

                'reviews' => SubmissionReview::where('submission_id', $submissionId)->orderBy('id', 'desc')->get()->groupBy('review_cycle_id')->toArray(),
                'submission' => Submission::with('reviews')->find($submissionId),

            ]
        );
    }

    public function startReview($submissionId)
    {
        // dd($submissionId);
        try{ 
            $journal_info = DB::table('submissions')
                          ->where('id',$submissionId)
                          ->update([
                              'current_status'=>1
                          ]);  

            if($journal_info == 1){
                return redirect()->route('editor.assignReviewer',  $submissionId);
            }else{
                dd('This Journal is not Exists........');
            }              
            echo 'In the try block';
            // dd($journal_info);
            dd($journal_info);
        }catch(\Exception $e){
            echo 'In the catch block';
            echo $e->getMessage();
            // dd($e);
        }

        dd('the end');
        
        // dd('start review');
        // $review = ReviewCycle::where('submission_id', $submissionId)->where('editor_verdict', '=', '0');
        $cycle = ReviewCycle::where('submission_id', $submissionId);

        return view('editor.startReview',
            [
                'review' => $cycle->first(),
                'verdicts' => Status::all(),

                'submission' => Submission::with('reviews')->find($submissionId),

                'num_of_cycle' => $cycle->count(),
                'review_cycles' => $cycle->get(),

                'reviews' => SubmissionReview::where('submission_id', $submissionId)->orderBy('id', 'desc')->get()->groupBy('review_cycle_id')->toArray(),
                'submission' => Submission::with('reviews')->find($submissionId),

            ]
        );

        return redirect()->route('editor.submissions')->with(['danger' => 'Not Saved!']);
    }

    public function startReviewPost(Request $request, $submissionId)
    {

        $review = ReviewCycle::where('submission_id', $submissionId)->where('editor_verdict', '=', '0')->first();

        if ($review != null && $request->verdict == null) {
            return redirect()->route('editor.submissions')->with(['danger' => 'Not Saved!']);
        }

        if ($request->verdict === 'start') {
            $submission = Submission::find($submissionId);
            $submission->current_status = '1';
            $submission->save();

            $cycle = new ReviewCycle();
            $cycle->submission_id = $submissionId;
            $cycle->save();
            return redirect()->route('editor.submissions')->with(['success' => 'Submission review process update, and author have been notified.']);
        } else {
            $submission = Submission::find($submissionId);
            $submission->current_status = $request->verdict;
            $submission->save();

            $cycle = new ReviewCycle();
            $cycle->submission_id = $submissionId;
            $cycle->editor_verdict = $request->verdict;
            $cycle->save();
            return redirect()->route('editor.submissions')->with(['success' => 'Submission review process update, and author have been notified.']);
        }

        return redirect()->route('editor.submissions')->with(['danger' => 'Not Saved!']);
    }

    public function endReview($submissionId)
    {
        // -------------------------------
        $journal_info = DB::table('submissions')
                        ->select('id as journalId','userid','current_status as status','modif_start','modif_end','modif_submit','title')
                        ->where('id',$submissionId)
                        ->first();
                    
        $reviewer_info = DB::table('submission_reviewers')
                       ->join('users','users.id','submission_reviewers.reviewer_id')
                       ->select('users.id as reviewerId','users.name as reviewerName')
                       ->where('submission_reviewers.submission_id',$submissionId) 
                       ->where('submission_reviewers.accepted',1)
                       ->get();
       
            $reviews = DB::table('submission_reviews')
                    ->join('review_ratings','submission_reviews.rating','review_ratings.id')
                    ->where('submission_reviews.submission_id',$submissionId)
                    ->get();

        //  dd($reviews[0]->reviewer_id);

        $reviewDetails = [];
        
        foreach($reviewer_info as $k1=>$re_info){
            $reviewDetails[$k1]['reviewerId'] = $re_info->reviewerId;
            $reviewDetails[$k1]['reviewerName'] = $re_info->reviewerName;
            foreach($reviews as $k2=>$re){
                if($re_info->reviewerId === $re->reviewer_id){
                    $reviewDetails[$k1]['reviewerRatingNum'] = $re->rating;
                    $reviewDetails[$k1]['reviewerRating'] = $re->name;
                    $reviewDetails[$k1]['comments_to_editor'] = $re->comments_to_editor;
                    $reviewDetails[$k1]['file_to_editor'] = $re->file_to_editor;
                    $reviewDetails[$k1]['comments_to_author'] = $re->comments_to_author;
                    $reviewDetails[$k1]['file_to_author'] = $re->file_to_author;
                }
            }
        }
        // dd($reviewDetails);
        
        return view('editor.endReview',['journal_info'=>$journal_info,'reviewer_info'=>$reviewer_info,'reviews'=>$reviews,'reviewDetails'=>$reviewDetails
        ]);

        // -------------------------------

        // $review = ReviewCycle::where('submission_id', $submissionId)->where('editor_verdict', '=', '0')->first();
        // if ($review == null) {
        //     return redirect()->route('editor.submissions')->with(['danger' => 'Not Saved!']);
        // }

        // $cycle = ReviewCycle::where('submission_id', $submissionId);

        // return view('editor.endReview',
        //     [
        //         'review' => $review,
        //         'verdicts' => Status::all(),
        //         'num_of_cycle' => $cycle->count(),
        //         'reviews' => SubmissionReview::where('submission_id', $submissionId)->orderBy('id', 'desc')->get()->groupBy('review_cycle_id')->toArray(),
        //         'review_cycles' => $cycle->with('submission')->get(),
        //         'submission' => Submission::find($submissionId),
        //         'action' => route('editor.endReviewPost', [$submissionId, $review->id]),
        //     ]
        // );
    }

    public function endReviewPost(Request $request)
    {
        // $modif_last_date = Carbon::createFromFormat('Y-m-d H:i:s',$request['modification_deadline']);
        $modif_last_date = Carbon::parse($request['modification_deadline']);
        // echo $modif_last_date;
        // echo gettype($modif_last_date);
        // dd($request);

        DB::beginTransaction();


        try{
        $editor_verdict = DB::table('status')
                        ->where('id',$request['verdict'])
                        ->first();
        // dd($editor_verdict);

        $journal_update = DB::table('submissions')
                      ->where('id',$request['journal_id'])  
                      ->update([
                          'current_status'=>$request['verdict'],
                          'modif_start'=>$request['modif_start_date'],
                          'modif_end'=>$modif_last_date
                      ]);

        $sub_reviews_update = '';  

        if($request['send-to-author']){
            $sub_reviews_update = DB::table('submission_reviews')
                            ->where('submission_id',$request['journal_id'])       
                            ->whereIn('reviewer_id',$request['send-to-author'])        
                            ->update([
                                'broad_cast'=>1
                            ]);
        }               
                           
                            
        }catch(\Exception $e){
            DB::rollback();
            echo $e->getMessage();
            dd('Query Error..............');
        }                    
                            
        if($journal_update && $sub_reviews_update){
            DB::commit();
            // dd('success......'.$journal_update.' and  '.$sub_reviews_update);
            return redirect()->route('editor.technicalReview')->with(['success' => 'Review is set to ' . $editor_verdict->name . ' and author have been notified.']);
        }else{

            DB::rollback();
            dd('Error......Atleast One Author to comment must Required'.$journal_update.' and  '.$sub_reviews_update);

            // return redirect()->route('editor.submissions')->with(['error' => 'Some thing went WRONG']);
            return redirect()->route('editor.endReview',$request['journal_id'])->with(['error' => 'Some thing went WRONG! Please Submit Properly']);
        }                    
        // $review = ReviewCycle::where('submission_id', $submissionId)->where('editor_verdict', '=', '0')->first();
        // if ($request->verdict !== null && $review !== null) {

        //     $review->editor_verdict = $request->verdict;
        //     $review->end_date = Carbon::now();

        //     $submission = Submission::find($review->submission_id);
        //     $submission->current_status = $request->verdict;

        //     if ($review->save() && $submission->save()) {
        //         return redirect()->route('editor.submissions')->with(['success' => 'Review is set to ' . $review->verdict->name . ' and author have been notified.']);
        //     }
        // }

        // return redirect()->route('editor.submissions')->with(['danger' => 'Not Saved! Please submit form properly']);
    }

    public function endTechReview($submissionId){

        $journal_info = DB::table('submissions')
                      ->select('id as journalId','userid','current_status as status','modif_start','modif_end','modif_submit','title')
                      ->where('id',$submissionId)
                      ->first();
    
        $reviewer_info = DB::table('submission_reviewers')
                        ->join('users','users.id','submission_reviewers.reviewer_id')
                        ->select('users.id as reviewerId','users.name as reviewerName')
                        ->where('submission_reviewers.submission_id',$submissionId) 
                        ->where('submission_reviewers.accepted',1)
                        ->get();

        $reviews = DB::table('submission_reviews')
                    ->join('review_ratings','submission_reviews.rating','review_ratings.id')
                    ->where('submission_reviews.submission_id',$submissionId)
                    ->get();



        $reviewDetails = [];

        foreach($reviewer_info as $k1=>$re_info){
        $reviewDetails[$k1]['reviewerId'] = $re_info->reviewerId;
        $reviewDetails[$k1]['reviewerName'] = $re_info->reviewerName;
            foreach($reviews as $k2=>$re){
                if($re_info->reviewerId === $re->reviewer_id){
                    $reviewDetails[$k1]['reviewerRatingNum'] = $re->rating;
                    $reviewDetails[$k1]['reviewerRating'] = $re->name;
                    $reviewDetails[$k1]['comments_to_editor'] = $re->comments_to_editor;
                    $reviewDetails[$k1]['file_to_editor'] = $re->file_to_editor;
                    $reviewDetails[$k1]['comments_to_author'] = $re->comments_to_author;
                    $reviewDetails[$k1]['file_to_author'] = $re->file_to_author;
                }
            }
        }

        return view('editor.endReviewTech',['journal_info'=>$journal_info,'reviewer_info'=>$reviewer_info,'reviews'=>$reviews,'reviewDetails'=>$reviewDetails
        ]);
    }

    /**
     * Assingn Reviewer for Submissions
     *
     * @return \Illuminate\Http\Response
     */
    public function assignReviewer($submissionId)
    {

        $submission = Submission::find($submissionId);

        $all_current_reviewer = SubmissionReviewer::where('submission_id', $submission->id);

        $all_current_reviewer_count = $all_current_reviewer->count();
        $current_reviewer = [];
        $current_reviewer_status = [];

        $all_current_reviewer = $all_current_reviewer->get();

        foreach ($all_current_reviewer as $value) {
            $current_reviewer_status[$value->reviewer_id] = $value;
            array_push($current_reviewer, $value->reviewer_id);
        }

        $reviewers = User::whereHas("roles", function ($q) {
            $q->where("name", "reviewer");
        })->get();

        return view(
            'editor.assignReviewer',
            [
                'submission' => $submission,
                'reviewers' => $reviewers,
                'defaultDate' => Carbon::now()->addDays(7)->toDateString(),
                'current_reviewer' => $current_reviewer,
                'current_reviewer_status' => $current_reviewer_status,
                'all_current_reviewer' => $all_current_reviewer,
                'all_current_reviewer_count' => $all_current_reviewer_count,

            ]
        );
    }
    
        public function assignReviewerAutoComplete(Request $request){
        if($request['reviewerName'] ==''){
            return false;
        }
        $searchName = '%'.$request['reviewerName'].'%';
        $reviewers = DB::table('users')
                   ->join('model_has_roles','users.id','model_has_roles.model_id')
                   ->join('roles','roles.id','model_has_roles.role_id')
                   ->where('roles.name','reviewer')
                   ->where('users.email','LIKE',$searchName)
                   ->get();  
        
        $output = '<ul class="dropdown-menu" style="display:block;position:relative">';              
        if(count($reviewers)>0){
            foreach($reviewers as $re){
                $output .='<li class="reviewerList" data-id="'.$re->model_id.'"><a href="#">'.$re->email.'</a></li>';
            }
        }else{
            $output .='<li>No data found</li></ul>';
        }             
        return $output;
    }

    public function assignReviewerWithMail(Request $request){
        // dd($request->all());
        $reviewerId     = $request['reviewer_id'];
        $submissionId   = $request['submission_id'];
        $reviewLastDate = $request['review_last_date'];

        $reviewerDetails = DB::table('users')
                         ->where('id',$reviewerId)
                         ->first();

        $submissonDetails = DB::table('submissions')
                          ->select('id','userid','journal_code','current_status','title')
                          ->where('id',$submissionId)
                          ->first();
                          
        $chkPreviouslyAssigned = DB::table('submission_reviewers')
                                ->where('submission_id',$submissionId)                  
                                ->where('reviewer_id',$reviewerId)                  
                                ->get();
                         
        if(count($chkPreviouslyAssigned)>0){
            $updateData = DB::table('submission_reviewers')
                         ->where('submission_id',$submissionId)                  
                         ->where('reviewer_id',$reviewerId)
                         ->update([
                               'review_last_date'=>$reviewLastDate 
                         ]);
        }else{
            $insertData = DB::table('submission_reviewers')
                        ->insert([
                            'submission_id'=>$submissionId,
                            'reviewer_id'=>$reviewerId,
                            'review_last_date'=>$reviewLastDate
                        ]);
        }     

        // dd($reviewerDetails);
        
        Mail::to($reviewerDetails->email ?? 'email@email.com')
                     ->send(new NotifyReviewer(
                        $reviewerDetails->name ?? 'estimed user',
                        $submissonDetails->title ?? ' Title Not Given',
                        $submissonDetails->id,
                        $reviewLastDate,
                        $reviewerDetails->id,
                        $reviewerDetails->email,
                        $reviewerDetails->view_password
                    ));

        return redirect()->route('editor.assignReviewer',$submissionId);        
        
    }

    /**
     * Assingn Reviewer for Submissions
     *
     * @return \Illuminate\Http\Response
     */
    public function assignReviewerPost(assignReviewerValidate $request, $submissionId)
    {

        if (empty($request->reviewer)) {
            return redirect()->back()->withInput()->with(['warning' => 'No reviewer assigned']);
        }

        // $current_review = Review::where('submission_id', $submissionId)->where('editor_verdict', '=', '0');

        // if ($current_review->count() == 1) {
        //     $submissions_submitted_for_review = $current_review->first()->id;
        // } else {
        //     return redirect()->back()->withInput()->with(['warning' => 'No reviewer assigned']);
        // }

        foreach ($request->reviewer as $key => $value) {
            if (isset($value['selected']) && $value['selected'] == 'on') {
                $reviewer = SubmissionReviewer::updateOrCreate(
                    [
                        // 'submissions_submitted_for_review' => $submissions_submitted_for_review,
                        'reviewer_id' => $key,
                        'review_last_date' => $value['date'],
                        'submission_id' => $submissionId,
                    ]
                );
                Mail::to($reviewer->user->email ?? 'email@email.com')
                    ->send(new NotifyReviewer(
                        $reviewer->user->name ?? 'estimed user',
                        $reviewer->submission->title ?? ' Title Not Given',
                        $value['date'],
                        $key,
                        $reviewer->user->email,
                        $reviewer->user->view_password
                    ));
            }
        }

        return redirect()->route('editor.submissions')->with(['success' => 'Reviewers Assigned to Submission #' . $submissionId]);
    }
}

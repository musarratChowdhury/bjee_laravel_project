<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
	return view('welcome');
})->name('home');

Route::get('/instructions-to-authors', function () {
	return view('instructions-to-authors');
})->name('instructions-to-authors');
Route::get('/subscription-and-advertisement-policy', function () {
	return view('subscription-and-advertisement-policy');
})->name('subscription-and-advertisement-policy');
Route::get('/editorial-board', function () {
	return view('editorial-board');
})->name('editorial-board');
Route::get('/editor-panel', function () {
	return view('editor-panel');
})->name('editor-panel');
Route::get('/necessary-information-bjee', function () {
	return view('necessary-information-bjee');
})->name('necessary-information-bjee');

Route::middleware('auth')->group(function () {

	Route::get('review', function () {
		return view('review');
	})->name('review');

	/** Temporary needs lots of checking for authorization, role, permission */
	Route::get('pdf-download/{submissionId}/{fileId}', 'DownloadController@downloadWord')->name('downloadWord')->middleware('role:superadmin|editor|reviewer|author');
	Route::get('word-download/{submissionId}/{fileId}', 'DownloadController@downloadPdf')->name('downloadPdf')->middleware('role:superadmin|editor|reviewer|author');
	Route::get('numbered-download/{submissionId}', 'DownloadController@downloadNumbered')->name('downloadNumbered')->middleware('role:superadmin|editor|reviewer|author');

	Route::get('review-download/{reviewId}', 'DownloadController@downloadMyReview')->name('downloadMyReview')->middleware('role:superadmin|editor|reviewer|author');

	/** Temporary needs lots of checking for authorization, role, permission */

	Route::get('submission/{submissionId}/step2-download-pdf/{fileId}', 'AuthorSubmissionController@step2DownloadPDF')->name('submission.step2DownloadPDF')->middleware('role:author|superadmin|editor');
	Route::get('submission/{submissionId}/step2-download-word/{fileId}', 'AuthorSubmissionController@step2DownloadWord')->name('submission.step2DownloadWord')->middleware('role:author|superadmin|editor');

	Route::get('download-review-file/{submissionReviewId}', 'DownloadController@downloadReviewFile')->name('downloadReviewFile')->middleware('role:author|superadmin|editor|reviewer');

	Route::get('review/pdf/{submissionId}/{fileId}', 'ReviewerController@viewPdf')->middleware('role:superadmin|editor|author|reviewer');

	Route::prefix('admin')->middleware('role:superadmin')->name('admin.')->group(function () {
		Route::get('users', 'AdminController@users')->name('users');
		Route::get('add-new-user', 'AdminController@addNewUser')->name('addNewUser');
		Route::post('save-new-user', 'AdminController@saveNewUser')->name('saveNewUser');
	});

	// Route::get('submissions', 'SubmissionController@index')->name('submissions');



	/** Editor Section
	 */
	Route::prefix('editor')->middleware('role:superadmin|editor')->name('editor.')->group(function () {

		Route::get('show/{submissionId}/{fileId}', 'EditorController@showfile')->name('showfile');


		Route::get('submissions', 'EditorController@submissions')->name('submissions');

		Route::prefix('submission/{submissionId}/')->group(function ($submissionId) {

			Route::get('details', 'EditorController@showSubmission')->name('showSubmission');
			Route::get('read-reviews', 'EditorController@checkSubmissionReviews')->name('checkSubmissionReviews');

			Route::get('start-review', 'EditorController@startReview')->name('startReview');
			Route::post('start-review-save', 'EditorController@startReviewPost')->name('startReviewPost');

			Route::get('end-review', 'EditorController@endReview')->name('endReview');
			Route::post('end-review-save/{review_cycle_id}', 'EditorController@endReviewPost')->name('endReviewPost');



			Route::get('assign-reviewer', 'EditorController@assignReviewer')->name('assignReviewer');
			Route::post('assign-reviewer-save', 'EditorController@assignReviewerPost')->name('assignReviewerPost');

			Route::get('end-review', 'EditorController@endReview')->name('endReview');
		});



		Route::prefix('reviewers/')->group(function () {
			Route::get('', 'EditorController@reviewers')->name('reviewers');
			Route::get('add-new', 'EditorController@addNewReviewer')->name('addNewReviewer');
			Route::post('save-new', 'EditorController@saveNewReviewer')->name('saveNewReviewer');
		});
	});


	Route::prefix('reviewer')->middleware('role:reviewer')->name('reviewer.')->group(function () {
		Route::get('submissions', 'ReviewerController@submissions')->name('submissions');

		Route::prefix('submission/{submissionId}/')->group(function ($submissionId) {
			Route::get('details', 'ReviewerController@showSubmission')->name('showSubmission');

			Route::get('review-submission', 'ReviewerController@reviewSubmission')->name('review');
			Route::get('review-detail', 'ReviewerController@showMyReviews')->name('reviewDetails');
		});

		Route::get('review-accept/{reviewerId}', 'ReviewerController@acceptedToReview')->name('acceptedToReview');
		Route::get('review-decline/{reviewerId}', 'ReviewerController@declineToReview')->name('declineToReview');

		Route::post('review-submit/{submissionId}', 'ReviewerController@submitReview')->name('submitReview');
	});



	Route::prefix('author')->middleware('role:author')->group(function ($submissionId) {

		Route::get('', 'AuthorController@index')->name('author');
		Route::get('view-submission-detail/{submissionId}', 'SubmissionController@show')->name('submission.show');

		Route::get('start-submission', function () {
			return view('author.submissions');
		})->name('startSubmission');

		Route::post('/create-submission', 'AuthorController@createSubmission')->name('createSubmission');

		Route::prefix('submission/{submissionId}/')->group(function ($submissionId) {
			Route::get('/view-reviews', 'AuthorController@viewReviews')->name('viewReviews');

			Route::get('/delete', 'AuthorController@deleteSubmission')->name('deleteSubmission');
			Route::get('/output', 'AuthorController@outputSubmissions')->name('outputSubmissions');
		});

		/** Submission Page : Start */

		Route::middleware('CanSubmissionBeEdited')->prefix('submission/{submissionId}/')->name('submission.')->group(function ($submissionId) {

			/** Step 1 : start */
			Route::get('step1', 'AuthorSubmissionController@step1')->name('step1');
			Route::post('step1-upload', 'AuthorSubmissionController@step1Post')->name('step1Post');
			/** Step 1 : End */

			/** Step 2 : start */
			Route::get('step2', 'AuthorSubmissionController@step2')->name('step2');
			Route::post('step2-upload', 'AuthorSubmissionController@step2Upload')->name('step2Upload');

			Route::get('step2-delete/{fileId}', 'AuthorSubmissionController@step2DeleteFile')->name('step2DeleteFile');
			/** Step 2 : End */

			/** Step 3 : start */
			Route::get('step3', 'AuthorSubmissionController@step3')->name('step3');
			Route::post('step3-upload', 'AuthorSubmissionController@step3Post')->name('step3Post');
			Route::post('step3-delete-keyword/{keywordId}', 'AuthorSubmissionController@step3DeleteKeyWord')->name('step3DeleteKeyword');
			/** Step 3 : End */

			/** Step 4 : start */
			Route::get('step4', 'AuthorSubmissionController@step4')->name('step4');
			Route::post('step4-upload', 'AuthorSubmissionController@step4Post')->name('step4Post');
			Route::post('step3-delete-author/{authorId}', 'AuthorSubmissionController@step4AuthorDelete')->name('step4AuthorDelete');

			/** Step 4 : End */

			/** Step 5 : start */
			Route::get('step5', 'AuthorSubmissionController@step5')->name('step5');
			Route::post('step5-upload', 'AuthorSubmissionController@step5Post')->name('step5Post');
			/** Step 5 : End */

			/** Step 6 : start */
			Route::get('step6', 'AuthorSubmissionController@step6')->name('step6');
			Route::post('step6-upload', 'AuthorSubmissionController@step6Post')->name('step6Post');
			/** Step 6 : End */
		});

		/** Submission Page : End */
	});
});

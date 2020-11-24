<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/', function () {
	return view('welcome');
})->name('home');

Route::get('/test-mail',function(){
    
    // $data = [
    //         'name'   => 'abid shiddique',
    //         'email_to'   => 'abidshiddique17@gmail.com',
    //         'email_from'   => 'info@bjee.com.bd',
    //         'subject'   => 'Congratulation!',
    //     ];
        
        
    //  Mail::send([], $data, function ($message) use ($data) {            
    //     $message->to($data['email_to']);
    //     $message->from($data['email_from'],'BAES');
    //     $message->subject($data['subject']);
    //     $message->setBody('This is a body');
    //  });
    
    $details['email'] = 'abidshiddique17@gmail.com';
    //$details['email'] = 'abidshiddique01@gmail.com';
    $email = new App\Mail\SendEmailTest();
    
    for($i=0;$i<2;$i++){
        dispatch(new App\Jobs\SendEmailJob($details['email']));
    }
    
    $exitCode = Artisan::call('queue:work --once');

    
    dd('test mail');
});


Route::get('/about', function () {
	return view('about');
})->name('about');
Route::get('/instructions-to-authors', function () {
	return view('instructions-to-authors');
})->name('instructions-to-authors');
Route::get('/subscription-and-advertisement-policy', function () {
	return view('subscription-and-advertisement-policy');
})->name('subscription-and-advertisement-policy');
Route::get('/modification', function () {
	return view('author.modification');
})->name('modification');
Route::get('/editorial-board', function () {
	return view('editorial-board');
})->name('editorial-board');
Route::get('/editor-panel', function () {
	return view('editor-panel');
})->name('editor-panel');
Route::get('/contacts', function () {
	return view('contacts');
})->name('contacts');


// Route::get('/archive', function () {
// 	return view('archive');
// })->name('archive');
Route::get('/list-articles-under-volume', function () {
	return view('list-articles-under-volume');
})->name('list-articles-under-volume');

Route::get('/list-articles-volume-30', function () {
	return view('list-articles-volume-30');
});
Route::get('/list-articles-volume-31-1', function () {
	return view('list-articles-volume-31-1');
});
Route::get('/list-articles-volume-31-2', function () {
	return view('list-articles-volume-31-2');
});



Route::get('/editor/journals', 'JournalController@index')->name('editor.journals');
Route::get('/editor/add-journal', 'JournalController@create')->name('editor.create-journal');
Route::post('/editor/add-journal', 'JournalController@store')->name('editor.store-journal');
Route::get('/editor/edit-journal/{id}', 'JournalController@edit')->name('editor.edit-journal');
Route::put('/editor/edit-journal/{id}', 'JournalController@update')->name('editor.update-journal');
Route::delete('/editor/delete-journal/{id}', 'JournalController@destroy')->name('editor.delete-journal');
Route::get('/editor/show-journal/{id}', 'JournalController@show')->name('editor.show-journal');

Route::get('/editor/volumes','volumeController@index')->name('editor.volumes');
Route::get('/editor/add-volume','volumeController@create')->name('editor.create-volume');
Route::post('/editor/add-volume','volumeController@store')->name('editor.store-volume');
Route::get('/editor/edit-volume/{id}','volumeController@edit')->name('editor.edit-volume');
Route::delete('/editor/delete-volume/{id}', 'volumeController@destroy')->name('editor.delete-volume');
Route::get('/editor/show-volume/{id}', 'volumeController@show')->name('editor.show-volume');
Route::put('/editor/add-volume/{id}','volumeController@update')->name('editor.update-volume');

Route::get('/editor/article-author','articleAuthorController@index')->name('editor.article-author');
Route::get('/editor/add-article-author','articleAuthorController@create')->name('editor.create-article-author');
Route::post('/editor/add-article-author','articleAuthorController@store')->name('editor.store-article-author');
Route::get('/editor/show-article-author/{id}','articleAuthorController@show')->name('editor.show-article-author');
Route::get('/editor/edit-article-author/{id}','articleAuthorController@edit')->name('editor.edit-article-author');
Route::Put('/editor/add-article-author/{id}','articleAuthorController@update')->name('editor.update-article-author');
Route::delete('/editor/delete-article-author/{id}','articleAuthorController@destroy')->name('editor.delete-article-author');

Route::get('/editor/instructions','utilityController@index')->name('editor.instructions');
Route::get('/editor/add-instruction','utilityController@create')->name('editor.create-instruction');
Route::post('/editor/add-instruction','utilityController@store')->name('editor.store-instruction');
Route::get('/editor/edit-instruction/{id}','utilityController@edit')->name('editor.edit-instruction');
Route::delete('/editor/delete-instruction/{id}', 'utilityController@destroy')->name('editor.delete-instruction');
Route::get('/editor/show-instruction/{id}', 'utilityController@show')->name('editor.show-instruction');
Route::put('/editor/add-instruction/{id}','utilityController@update')->name('editor.update-instruction');

Route::get('/editor/ed-board-position','Ed_board_pos_controller@index')->name('editor.ed-board-position');
Route::get('/editor/add-ed-board-position','Ed_board_pos_controller@create')->name('editor.create-ed-board-position');
Route::post('/editor/add-ed-board-position','Ed_board_pos_controller@store')->name('editor.store-ed-board-position');
Route::get('/editor/edit-ed-board-position/{id}','Ed_board_pos_controller@edit')->name('editor.edit-ed-board-position');
Route::delete('/editor/delete-ed-board-position/{id}', 'Ed_board_pos_controller@destroy')->name('editor.delete-ed-board-position');
Route::get('/editor/show-ed-board-position/{id}', 'Ed_board_pos_controller@show')->name('editor.show-ed-board-position');
Route::put('/editor/add-ed-board-position/{id}','Ed_board_pos_controller@update')->name('editor.update-ed-board-position');

Route::get('/editor/ed-board-position-details','Ed_board_pos_detail_controller@index')->name('editor.ed-board-position-details');
Route::get('/editor/add-ed-board-position-details','Ed_board_pos_detail_controller@create')->name('editor.create-ed-board-position-details');
Route::post('/editor/add-ed-board-position-details','Ed_board_pos_detail_controller@store')->name('editor.store-ed-board-position-details');
Route::get('/editor/edit-ed-board-position-details/{id}','Ed_board_pos_detail_controller@edit')->name('editor.edit-ed-board-position-details');
Route::delete('/editor/delete-ed-board-position-details/{id}', 'Ed_board_pos_detail_controller@destroy')->name('editor.delete-ed-board-position-details');
Route::get('/editor/show-ed-board-position-details/{id}', 'Ed_board_pos_detail_controller@show')->name('editor.show-ed-board-position-details');
Route::put('/editor/add-ed-board-position-details/{id}','Ed_board_pos_detail_controller@update')->name('editor.update-ed-board-position-details');

Route::get('/archive','JournalController@archive')->name('archive');
Route::get('/volume/{id}','JournalController@journalsInVolume')->name('journalsInVolume');
Route::get('/volume/{volId}/page/{pageNo}','JournalController@journalsInVolumePage')->name('journalsInVolumePage');

// articles
Route::get('/article-01', function () {
	return view('articles.article-01');
})->name('article-01');
Route::get('/article-02', function () {
	return view('articles.article-02');
})->name('article-02');
Route::get('/article-03', function () {
	return view('articles.article-03');
})->name('article-03');
Route::get('/article-04', function () {
	return view('articles.article-04');
})->name('article-04');
Route::get('/article-05', function () {
	return view('articles.article-05');
})->name('article-05');
Route::get('/article-06', function () {
	return view('articles.article-06');
})->name('article-06');
Route::get('/article-07', function () {
	return view('articles.article-07');
})->name('article-07');
Route::get('/article-08', function () {
	return view('articles.article-08');
})->name('article-08');
Route::get('/article-09', function () {
	return view('articles.article-09');
})->name('article-09');
Route::get('/article-10', function () {
	return view('articles.article-10');
})->name('article-10');

Route::get('/article-31-1', function () {
	return view('articles.article-31-1');
})->name('article-31-1');
Route::get('/article-31-2', function () {
	return view('articles.article-31-2');
})->name('article-31-2');
Route::get('/article-31-3', function () {
	return view('articles.article-31-3');
})->name('article-31-3');
Route::get('/article-31-4', function () {
	return view('articles.article-31-4');
})->name('article-31-4');
Route::get('/article-31-5', function () {
	return view('articles.article-31-5');
})->name('article-31-5');
Route::get('/article-31-6', function () {
	return view('articles.article-31-6');
})->name('article-31-6');
Route::get('/article-31-7', function () {
	return view('articles.article-31-7');
})->name('article-31-7');
Route::get('/article-31-8', function () {
	return view('articles.article-31-8');
})->name('article-31-8');
Route::get('/article-31-9', function () {
	return view('articles.article-31-9');
})->name('article-31-9');
Route::get('/article-31-10', function () {
	return view('articles.article-31-10');
})->name('article-31-10');
Route::get('/article-31-11', function () {
	return view('articles.article-31-11');
})->name('article-31-11');
Route::get('/article-31-12', function () {
	return view('articles.article-31-12');
})->name('article-31-12');
Route::get('/article-31-13', function () {
	return view('articles.article-31-13');
})->name('article-31-13');
Route::get('/article-31-14', function () {
	return view('articles.article-31-14');
})->name('article-31-14');
Route::get('/article-31-15', function () {
	return view('articles.article-31-15');
})->name('article-31-15');
Route::get('/article-31-16', function () {
	return view('articles.article-31-16');
})->name('article-31-16');
Route::get('/article-31-17', function () {
	return view('articles.article-31-17');
})->name('article-31-17');


Route::middleware('auth')->group(function () {

	Route::get('review', function () {
		return view('review');
	})->name('review');

	/** Temporary needs lots of checking for authorization, role, permission */
	Route::get('pdf-download/{submissionId}/{fileId}', 'DownloadController@downloadWord')->name('downloadWord')->middleware('role:superadmin|editor|reviewer|author');
	Route::get('word-download/{submissionId}/{fileId}', 'DownloadController@downloadPdf')->name('downloadPdf')->middleware('role:superadmin|editor|reviewer|author');
	Route::get('numbered-download/{submissionId}', 'DownloadController@downloadNumbered')->name('downloadNumbered')->middleware('role:superadmin|editor|reviewer|author');

    Route::get('review-download/{submissionId}/{reviewerId}/{status}', 'DownloadController@downloadMyReview')->name('downloadMyReview')->middleware('role:superadmin|editor|reviewer|author');

	/** Temporary needs lots of checking for authorization, role, permission */

	Route::get('submission/{submissionId}/step2-download-pdf/{fileId}', 'AuthorSubmissionController@step2DownloadPDF')->name('submission.step2DownloadPDF')->middleware('role:author|superadmin|editor');
	Route::get('submission/{submissionId}/step2-download-word/{fileId}', 'AuthorSubmissionController@step2DownloadWord')->name('submission.step2DownloadWord')->middleware('role:author|superadmin|editor');

	Route::get('download-review-file/{submissionReviewId}', 'DownloadController@downloadReviewFile')->name('downloadReviewFile')->middleware('role:author|superadmin|editor|reviewer');

	Route::get('review/pdf/{submissionId}/{fileId}', 'ReviewerController@viewPdf')->middleware('role:superadmin|editor|author|reviewer');

	Route::prefix('admin')->middleware('role:superadmin')->name('admin.')->group(function () {
		Route::get('users', 'AdminController@users')->name('users');
		Route::get('manage-user/{userid}', 'AdminController@manageUser')->name('manageUser');
		Route::post('manage-user-post/{userid}', 'AdminController@manageUserPost')->name('manageUserPost');

		Route::get('add-new-user', 'AdminController@addNewUser')->name('addNewUser');
		Route::post('save-new-user', 'AdminController@saveNewUser')->name('saveNewUser');
	});

	// Route::get('submissions', 'SubmissionController@index')->name('submissions');



	/** Editor Section
	 */
	Route::prefix('editor')->middleware('role:superadmin|editor')->name('editor.')->group(function () {

		Route::get('show/{submissionId}/{fileId}', 'EditorController@showfile')->name('showfile');


		Route::get('submissions', 'EditorController@submissions')->name('submissions');
		
		Route::get('in-review', 'EditorController@inReview')->name('inReview');
		Route::get('technical-review', 'EditorController@technicalReview')->name('technicalReview');
		Route::get('ready-to-publish', 'EditorController@readyToPublish')->name('readyToPublish');

		Route::prefix('submission/{submissionId}/')->group(function ($submissionId) {

			Route::get('details', 'EditorController@showSubmission')->name('showSubmission');
			Route::get('read-reviews', 'EditorController@checkSubmissionReviews')->name('checkSubmissionReviews');

			Route::get('start-review', 'EditorController@startReview')->name('startReview');
			Route::post('start-review-save', 'EditorController@startReviewPost')->name('startReviewPost');
			Route::post('ajax_assReviewer_autocomplete', 'EditorController@assignReviewerAutoComplete');

			Route::get('end-review', 'EditorController@endReview')->name('endReview');
// 			Route::post('end-review-save/{review_cycle_id}', 'EditorController@endReviewPost')->name('endReviewPost');



			Route::get('assign-reviewer', 'EditorController@assignReviewer')->name('assignReviewer');
			Route::post('assign-reviewer-save', 'EditorController@assignReviewerPost')->name('assignReviewerPost');

			Route::get('end-review', 'EditorController@endReview')->name('endReview');
			Route::get('end-tech-review', 'EditorController@endTechReview')->name('endTechReview');
		});
		Route::post('end-review-save', 'EditorController@endReviewPost')->name('endReviewPost');
		Route::post('assign-reviewer-with-mail', 'EditorController@assignReviewerWithMail');	



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
		
		Route::get('review-accept/{reviewerId}/{submissionId}', 'ReviewerController@acceptedToReview')->name('acceptedToReview');
		Route::get('review-decline/{reviewerId}/{submissionId}', 'ReviewerController@declineToReview')->name('declineToReview');

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
			Route::get('/view-mod-message','AuthorController@modMessage')->name('viewModMessage');

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
			Route::post('step3-delete-keyword', 'AuthorSubmissionController@step3DeleteKeyWord')->name('step3DeleteKeyword');
			/** Step 3 : End */

			/** Step 4 : start */
			Route::get('step4', 'AuthorSubmissionController@step4')->name('step4');
			Route::post('step4-upload', 'AuthorSubmissionController@step4Post')->name('step4Post');
			Route::post('step3-delete-author', 'AuthorSubmissionController@step4AuthorDelete')->name('step4AuthorDelete');

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

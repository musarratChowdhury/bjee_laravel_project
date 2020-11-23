<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submissions', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('userid');
			$table->string('current_status', 1)->default('0')->comment('Shows current status of the submission; from status table');
			$table->dateTime('review_start_date')->nullable();
			$table->dateTime('review_end_date')->nullable();
			$table->text('title', 65535)->nullable()->comment('step-1');
			$table->integer('type')->nullable()->comment('step-1');
			$table->text('running_head', 65535)->nullable()->comment('step-1');
			$table->text('abstract', 65535)->nullable()->comment('step-1');
			$table->integer('special_issue')->nullable()->comment('step-1: Is the manuscript a candidate for a special issue?');
			$table->text('comments', 65535)->nullable()->comment('step-1');
			$table->text('cover_letter', 65535)->nullable()->comment('step-5');
			$table->text('upload_cover_letter', 65535)->nullable()->comment('step-5');
			$table->boolean('funding')->nullable()->comment('step-5');
			$table->text('number_of_figures', 65535)->nullable()->comment('step-5');
			$table->text('number_of_color_figures', 65535)->nullable()->comment('step-5');
			$table->text('number_of_tables', 65535)->nullable()->comment('step-5');
			$table->text('number_of_words', 65535)->nullable()->comment('step-5');
			$table->boolean('manuscript_previously')->nullable()->comment('step-5: Has this manuscript been submitted previously to this journal? (yes/no');
			$table->text('manuscript_id', 65535)->nullable()->comment('step-5: Has this manuscript been submitted previously to this journal?If yes, what is the manuscript ID of the previous submission?');
			$table->boolean('color_reproduction')->nullable()->comment('step-5: Are you willing to pay the journal\'s fee for color reproduction?');
			$table->boolean('confirm_not_published')->nullable()->comment('step-5: Confirm that the manuscript has been submitted solely to this journal and is not published, in press, or submitted elsewhere.');
			$table->boolean('confirm_ethical')->nullable()->comment('step-5: Confirm that all the research meets the ethical guidelines, including adherence to the legal requirements of the study country.');
			$table->boolean('confirm_acknowledgements')->nullable()->comment('step-5: Confirm that you have prepared (a) a complete text and (b) complete text minus the title page, acknowledgements, and any running headers of author names, to allow blinded review.');
			$table->boolean('conflict_of_interest')->nullable()->comment('step-5');
			$table->text('conflict_of_interest_yes', 65535)->nullable()->comment('step-5: if conflict of interest exists');
			$table->boolean('copyright')->nullable()->comment('step-5');
			$table->boolean('data_set_associated')->nullable()->comment('step-5: Is there a data set associated with this submission?');
			$table->text('data_set_associated_yes', 65535)->nullable()->comment('step-5: Is there a data set associated with this submission? Yes');
			$table->boolean('confirm_recommendation')->nullable()->comment('step-5: Please check this box to confirm that you have read and understood this recommendation.');
			$table->string('human_subjects', 1)->nullable()->comment('step-5: Reporting on Human Subjects');
			$table->text('human_subjects_details_c', 65535)->nullable()->comment('step-5: If you answered c above, please detail how you protected your study participants.');
			$table->date('human_subjects_details_d')->nullable()->comment('step-5: you answered d above, please provide date of approval. Note that you may be required to provide the protocol at a later date.');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('submissions');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionReviewersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission_reviewers', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('submission_id');
			$table->bigInteger('reviewer_id');
			$table->date('review_last_date');
			$table->boolean('accepted')->nullable()->comment('0 = rejected, 1 = accepted');
			$table->dateTime('accepted_time')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('submission_reviewers');
	}

}

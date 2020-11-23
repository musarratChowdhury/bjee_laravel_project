<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission_reviews', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->boolean('status')->default(0);
			$table->bigInteger('review_cycle_id');
			$table->bigInteger('submission_id');
			$table->bigInteger('reviewer_id');
			$table->integer('rating')->nullable();
			$table->text('comments', 65535)->nullable();
			$table->text('file', 65535)->nullable();
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
		Schema::drop('submission_reviews');
	}

}

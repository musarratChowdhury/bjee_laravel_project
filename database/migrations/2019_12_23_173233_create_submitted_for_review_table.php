<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmittedForReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submitted_for_review', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('submission_id');
			$table->bigInteger('editor_decision')->comment('from editor decision options');
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
		Schema::drop('submitted_for_review');
	}

}

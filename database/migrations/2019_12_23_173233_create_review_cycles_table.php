<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewCyclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('review_cycles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('submission_id');
			$table->bigInteger('editor_verdict')->default(0)->comment('from status table');
			$table->timestamps();
			$table->dateTime('end_date')->nullable();
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
		Schema::drop('review_cycles');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission_files', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('submission_id');
			$table->bigInteger('userid');
			$table->text('pdf', 65535);
			$table->text('word', 65535);
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
		Schema::drop('submission_files');
	}

}

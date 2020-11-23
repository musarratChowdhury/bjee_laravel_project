<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionAuthorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission_authors', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('submission_id');
			$table->integer('author_order')->nullable();
			$table->text('name', 65535)->nullable();
			$table->text('email', 65535)->nullable();
			$table->text('institution', 65535)->nullable();
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
		Schema::drop('submission_authors');
	}

}

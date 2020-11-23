<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionAuthor extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'submission_authors';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionType extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'submission_types';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];
}

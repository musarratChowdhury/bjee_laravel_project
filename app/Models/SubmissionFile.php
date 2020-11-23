<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubmissionFile extends Model
{
		use SoftDeletes;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'submission_files';

	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo('App\User', 'userid');
	}

	public function submission()
	{
		return $this->belongsTo('App\Models\Submissions', 'submission_id');
	}
}

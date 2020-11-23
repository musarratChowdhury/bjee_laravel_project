<?php

namespace App\Models\Reviews;

use Illuminate\Database\Eloquent\Model;

class SubmissionReview extends Model
{
	protected $table = 'submission_reviews';
	protected $guarded = [];

	public function submission()
	{
		return $this->hasOne(\App\Models\Submission::class, 'id', 'submission_id');
	}
	
	public function verdict()
	{
		return $this->hasOne(\App\Models\Options\Status::class, 'id', 'editor_verdict');
	}
}

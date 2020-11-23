<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionReviewer extends Model
{
	protected $table = 'submission_reviewers';
	protected $guarded = [];

	public function user()
	{
		return $this->hasOne(\App\User::class, 'id', 'reviewer_id');
	}

	public function reviewCycle()
	{
		return $this->hasOne(\App\Models\Review::class, 'id', 'submissions_submitted_for_review');
	}

	public function reviews()
	{
		return $this->hasMany(\App\Models\Reviews\SubmissionReview::class,'submission_id', 'id');
	}

	public function submission()
	{
		return $this->hasOne(\App\Models\Submission::class, 'id', 'submission_id');
	}
}

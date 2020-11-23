<?php

namespace App\Models\Reviews;

use Illuminate\Database\Eloquent\Model;

class ReviewCycle extends Model
{
   /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'review_cycles';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function submission()
	{
		return $this->hasOne(\App\Models\Submission::class, 'id', 'submission_id');
	}

	public function reviews()
	{
		return $this->hasMany(\App\Models\Reviews\SubmissionReview::class, 'submission_id', 'id');
	}

	public function verdict()
	{
		return $this->hasOne(\App\Models\Options\Status::class, 'id', 'editor_verdict');
	}
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
	use SoftDeletes;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'submissions';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo('App\User', 'userid');
	}

	public function file()
	{
		return $this->hasOne('App\Models\SubmissionFile', 'submission_id');
	}

	public function typeName()
	{
		return $this->hasOne('App\Models\SubmissionType', 'id', 'type');
	}

	public function submissionType()
	{
		return $this->hasOne(\App\Models\SubmissionType::class, 'id', 'type');
	}

	public function status()
	{
		return $this->hasOne(\App\Models\Options\Status::class, 'id', 'current_status');
	}

	public function reviewers()
	{
		return $this->hasMany(\App\Models\Reviews\SubmissionReviewer::class, 'submission_id', 'id');
	}

	public function reviews()
	{
		return $this->hasMany(\App\Models\Reviews\SubmissionReview::class, 'submission_id', 'id');
	}

	public function specialIssue()
	{
		return $this->hasOne(\App\Models\SubmissionSpecialIssue::class, 'id', 'special_issue');
	}

	public function authors()
	{
		return $this->hasMany(\App\Models\SubmissionAuthor::class, 'submission_id', 'id');
	}
	
}

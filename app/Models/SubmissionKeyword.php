<?php

namespace App\Models;

use App\Models\Options\Keyword;
use Illuminate\Database\Eloquent\Model;

class SubmissionKeyword extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'submission_keywords';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function keyword()
	{
		return $this->hasOne(Keyword::class, 'id', 'keyword_id');
	}
}

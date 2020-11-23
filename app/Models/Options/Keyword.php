<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
     /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'keywords';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];
}

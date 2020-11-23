<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionStep1Validate extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'type' => 'required',
			'runninghead' => 'required',
			'abstract' => 'required',
			'title' => 'required',
			'number_of_words' => 'required|numeric'
		];
	}

	public function messages()
	{
		return [
			'type.required' => 'Type is required',
			'runninghead.required'  => 'Running Head is required',
			'abstract.required' => 'Abstract is required',
			'title.required'  => 'Comments is required',
			'number_of_words' => 'Number of Words id required'
		];
	}
}

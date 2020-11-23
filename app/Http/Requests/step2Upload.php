<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class step2Upload extends FormRequest
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

			'pdf' => 'required|mimes:pdf',
			'word' => 'required|mimes:doc,docx',
		];
	}

	public function messages()
	{
		return [
			'pdf.required' => 'PDF version is required',
			'word.required'  => 'MSWord Version is reqired',
			'pdf.mimes' => 'Only pdf file format is supported',
			'word.mimes'  => 'Only MSWord file format is supported',
		];
	}
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionStep5Validate extends FormRequest
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'number_of_figures' => 'required|numeric',
			'number_of_color_figures' => 'required|numeric',
			'number_of_tables' => 'required|numeric',
			'number_of_words' => 'required|numeric',
			'cover_letter' => 'required|string',
		];
	}

	public function messages()
	{
		return [
			'number_of_figures.required' => 'Number of Figures  is required.',
			'number_of_figures.numeric' => 'Number of   is required.',

			'number_of_color_figures.required' => 'Number of Color Figures is required.',
			'number_of_color_figures.numeric' => 'Number of Color Figures is required.',

			'number_of_tables.required' => 'Number of Tables is required.',
			'number_of_tables.numeric' => 'Number of Tables is required.',

			'number_of_words.required' => 'Number of Words is required.',
			'number_of_words.numeric' => 'Number of Words is required.',

			'cover_letter.required' => 'Cover letter is required.',
			'cover_letter.string' => 'Cover letter is required.',

		];
	}
}

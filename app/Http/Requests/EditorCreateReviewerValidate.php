<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditorCreateReviewerValidate extends FormRequest
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
			'username' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8',
		];
	}
	public function messages()
	{
		return [
			'username.required' => 'Name is Required',
			'username.string' => 'Name is Required',
			'username.max' => 'Name is not valid',

			'email.required' => 'Email is Required',
			'email.email' => 'Email is not valid',
			'email.max' => 'Email is not valid',
			'email.string' => 'Email is Required',
			'email.unique' => 'Email is already in use.',

			'password.string' => 'Password is Required',
			'password.required' => 'Password is Required',
			'password.min' => 'Password is too short, minimum 8 characters ',

		];
	}
}

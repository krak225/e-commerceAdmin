<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Auth;

class UserFormRequest extends FormRequest
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
			'nom' => 'required|string|max:255',
			'prenoms' => 'required|string|max:255',
            'profil_id' => 'required',
            'email' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
		];
    }
}

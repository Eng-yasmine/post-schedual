<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rules\Password;




use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255|min:3',
            'email'=> 'required|email:filter|unique:users,email',
            'password'=> ['required', 'confirmed', Password::default()],

        ];

    }
}

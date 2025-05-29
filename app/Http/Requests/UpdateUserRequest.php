<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

                'name' => 'required|string|max:255|min:3',
                'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
                'password' => 'nullable|password:default|confirm',
                'role' => 'required|in:admin,user,customer',

        ];
    }
}

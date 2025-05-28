<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:1000'],
            'image' => [ 'image', 'mimes:png,jpg', 'max:2048'],
            'status' => ['required', 'string', 'in:draft,scheduled,published'],
            'scheduled_time' => ['required', 'date', 'after_or_equal:now'],
        ];
    }

    }


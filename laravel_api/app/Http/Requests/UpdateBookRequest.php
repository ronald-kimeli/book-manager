<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'name' => 'string',
            'publisher' => 'string|max:50',
            'isbn' => 'string|max:50',
            'category' => 'string|max:100',
            'sub_category' => 'string|max:100',
            'description' => 'string',
            'pages' => 'integer',
            'image' => 'nullable|string|max:200',
            'added_by' => 'integer',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}

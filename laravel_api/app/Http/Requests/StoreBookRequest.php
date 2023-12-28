<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'name' => 'required|string|unique:books',
            'publisher' => 'required|string|max:50',
            'isbn' => 'required|string|max:50',
            'category' => 'required|string|max:100',
            'sub_category' => 'required|string|max:100',
            'description' => 'required|string',
            'pages' => 'required|integer',
            'image' => 'nullable|string|max:200',
            'added_by' => 'required|integer',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}

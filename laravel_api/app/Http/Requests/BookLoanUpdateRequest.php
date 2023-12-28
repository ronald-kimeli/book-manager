<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookLoanUpdateRequest extends FormRequest
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
            'user_id' => 'exists:users,id',
            'book_id' => 'exists:books,id',
            'loan_date' => 'date',
            'due_date' => 'date',
            'return_date' => 'date',
            'extended' => 'string|max:4',            'extension_date' => 'date',
            'penalty_amount' => 'integer',
            'penalty_status' => 'string',
            'status' => 'string',
        ];
    }
}

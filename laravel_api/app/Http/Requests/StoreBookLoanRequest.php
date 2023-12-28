<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookLoanRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date',
            'return_date' => 'nullable|date',
            'extended' => 'nullable|string|max:3',
            'extension_date' => 'nullable|date',
            'penalty_amount' => 'nullable|integer',
            'penalty_status' => 'nullable|string|max:15',
            'status' => 'nullable|string|max:20',
            'added_by' => 'required|exists:users,id',
        ];
    }
}

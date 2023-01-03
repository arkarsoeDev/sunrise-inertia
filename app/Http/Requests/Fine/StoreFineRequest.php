<?php

namespace App\Http\Requests\Fine;

use Illuminate\Foundation\Http\FormRequest;

class StoreFineRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'member_id' => ['required', 'exists:members,id'],
            'loan_id' => ['required', 'exists:loans,id','unique:fines,loan_id'],
            'fine_date' => ['required'],
            'fine_amount' => ['required'],
        ];
    }
}

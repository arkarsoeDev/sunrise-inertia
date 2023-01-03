<?php

namespace App\Http\Requests\FinePayment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFinePaymentRequest extends FormRequest
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
            'fine_id' => ['required', 'exists:fines,id', 'unique:fine_payments,fine_id,' . $this->route('fine_payment')->id],
            'payment_date' => ['required'],
            'payment_amount' => ['required'],
        ];
    }
}

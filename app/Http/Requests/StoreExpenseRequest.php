<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'expense_date'    => ['required', 'date'],
            'vendor_name'     => ['required', 'string', 'max:255'],
            'vendor_gstin'    => ['nullable', 'string', 'max:15'],
            'category'        => ['required', 'string', 'max:100'],
            'base_amount'     => ['required', 'numeric', 'min:0'],
            'cgst'            => ['nullable', 'numeric', 'min:0'],
            'sgst'            => ['nullable', 'numeric', 'min:0'],
            'igst'            => ['nullable', 'numeric', 'min:0'],
            'total_amount'    => ['required', 'numeric', 'min:0'],
            'payment_mode'    => ['nullable', 'string', 'max:100'],
            'receipt'         => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ];
    }
}

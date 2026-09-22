<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
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
        // Get the invoice from route for update requests
        $invoice = $this->route('invoice');
        $invoiceId = $invoice?->id;

        $allowedCurrencies = array_merge(['INR'], \App\Models\Currency::where('user_id', $this->user()->id)->where('is_active', true)->pluck('code')->toArray());
        if ($invoice) {
            $allowedCurrencies[] = $invoice->currency_code;
        }
        $allowedCurrencies = array_unique($allowedCurrencies);

        return [
            'client_id' => [
                'required',
                Rule::exists('clients', 'id')->where(function ($query) {
                    $query->where('user_id', $this->user()->id);
                }),
            ],
            'invoice_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('invoices', 'invoice_number')
                    ->where('user_id', $this->user()->id)
                    ->ignore($invoiceId),
            ],
            'invoice_date'    => ['required', 'date'],
            'due_date'        => ['nullable', 'date', 'after_or_equal:invoice_date'],
            'currency_code'   => [
                'required',
                'string',
                Rule::in($allowedCurrencies)
            ],
            'currency_symbol' => ['required', 'string', 'max:10'],
            'notes'           => ['nullable', 'string'],
            'bank_notes'      => ['nullable', 'string'],
            'status'          => ['required', 'string', 'in:draft,sent,paid,overdue'],
            'type'            => ['nullable', 'string', 'in:invoice,quotation'],
            'exchange_rate_inr'    => ['nullable', 'numeric', 'min:0'],
            'firc_number'          => ['nullable', 'string', 'max:255'],
            'actual_exchange_rate' => ['nullable', 'numeric', 'min:0'],
            'actual_inr_received'  => ['nullable', 'numeric', 'min:0'],

            // Nested Line Items validation
            'items'                  => ['required', 'array', 'min:1'],
            'items.*.item_name'      => ['required', 'string', 'max:255'],
            'items.*.description'    => ['nullable', 'string'],
            'items.*.sac_code'       => ['required', 'string', 'max:8'],
            'items.*.qty'            => ['required', 'numeric', 'min:0.01'],
            'items.*.rate'           => ['required', 'numeric', 'min:0'],
            'items.*.tax_percent'    => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
}

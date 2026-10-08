<?php

namespace App\Services;

use App\Models\Invoice;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class FemaDeclarationService
{
    /**
     * Generate a FEMA 23(R) / HDFC EDF Declaration Excel file for the given invoice.
     *
     * @param Invoice $invoice
     * @return string Path to the generated .xlsx file
     * @throws \RuntimeException
     */
    public function generate(Invoice $invoice): string
    {
        $invoice->loadMissing(['client', 'items', 'user.companySetting', 'payment']);

        $companySetting = $invoice->user->companySetting;
        $bankNotes = $invoice->bank_notes ?: ($companySetting?->bank_notes ?? '');

        // Extract banking details from bank notes using regex
        $accountNumber = '50200120756905';
        if (preg_match('/Account\s*Number\s*:\s*([^\r\n]+)/i', $bankNotes, $m)) {
            $accountNumber = trim($m[1]);
        }

        $bankName = 'HDFC Bank Ltd.';
        if (preg_match('/Bank\s*Name\s*:\s*([^\r\n]+)/i', $bankNotes, $m)) {
            $bankName = trim($m[1]);
        }

        $branchAddress = 'HDFC Bank Ltd., Upper Ground & First Floor, Anu Complex, Bekapur Market, Munger, Bihar, Pin-811201';
        if (preg_match('/Branch\s*Address\s*:\s*([^\r\n]+)/i', $bankNotes, $m)) {
            $branchAddress = trim($m[1]);
        }

        // Extract PAN from GSTIN (chars 3 to 12) or fallback
        $gstNumber = $companySetting?->gst_number ?? '10BZUPA6699D1Z7';
        $panNumber = 'BZUPA6699D';
        if (preg_match('/[A-Z]{5}[0-9]{4}[A-Z]/', $gstNumber, $m)) {
            $panNumber = $m[0];
        }

        $itemsData = [];
        foreach ($invoice->items as $item) {
            $itemsData[] = [
                'name'     => $item->item_name,
                'sac_code' => $item->sac_code ?: '998314',
                'amount'   => floatval($item->total ?? ($item->qty * $item->rate)),
            ];
        }

        if (empty($itemsData)) {
            $itemsData[] = [
                'name'     => 'Software Consultancy & IT Services',
                'sac_code' => '998314',
                'amount'   => floatval($invoice->grand_total),
            ];
        }

        $servicesDescription = $invoice->items->pluck('item_name')->filter()->join(', ');
        if (empty($servicesDescription)) {
            $servicesDescription = 'Software Consultancy, Development & IT Implementation Services';
        }

        $payload = [
            'invoice_number'        => $invoice->invoice_number,
            'invoice_date'          => $invoice->invoice_date ? $invoice->invoice_date->format('d-m-Y') : now()->format('d-m-Y'),
            'invoice_date_dmy'      => $invoice->invoice_date ? $invoice->invoice_date->format('d-m-Y') : now()->format('d-m-Y'),
            'request_letter_date'   => $invoice->payment?->payment_date ? $invoice->payment->payment_date->format('d-M-Y') : now()->format('d-M-Y'),
            'payment_date'          => $invoice->payment?->payment_date ? $invoice->payment->payment_date->format('d-M-Y') : null,
            'currency_code'         => $invoice->currency_code,
            'grand_total'           => floatval($invoice->grand_total),
            'inr_equivalent'        => floatval($invoice->inr_equivalent ?? 0),
            'exchange_rate_invoice' => floatval($invoice->exchange_rate_inr ?? 1.0),
            'exchange_rate_payment' => $invoice->payment?->exchange_rate_payment ? floatval($invoice->payment->exchange_rate_payment) : null,
            'inr_received'          => $invoice->payment?->inr_amount_received ? floatval($invoice->payment->inr_amount_received) : null,
            'firc_number'           => $invoice->payment?->firc_number ?? $invoice->firc_number,
            'services_description'  => $servicesDescription,
            'sac_code'              => $invoice->items->first()?->sac_code ?: '998314',
            'exporter'              => [
                'name'            => $companySetting?->company_name ?: 'COD XPERT',
                'address'         => $companySetting?->address ?: 'House No. 119, I.T.C. Colony, Shankarpur, Munger, Bihar 811201, India',
                'gstin'           => $gstNumber,
                'pan'             => $panNumber,
                'iec'             => $companySetting?->iec_number ?: 'N/A',
                'lut_number'      => $companySetting?->lut_number ?: 'AD100626002271U',
                'phone'           => $companySetting?->phone ?: '+91 9570512399',
                'email'           => $companySetting?->email ?: 'info@codxpert.com',
                'account_number'  => $accountNumber,
                'bank_name'       => $bankName,
                'branch_address'  => $branchAddress,
                'ad_name_address' => "{$bankName}, {$branchAddress}",
            ],
            'client'                => [
                'name'    => $invoice->client?->name ?: 'Overseas Client',
                'address' => $invoice->client?->address ?: 'Overseas Address',
                'country' => $invoice->client?->country ?: 'Overseas',
            ],
            'items'                 => $itemsData,
        ];

        $tempDir = storage_path('app/temp');
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0755, true);
        }

        $jsonPath = $tempDir . '/fema_input_' . uniqid() . '.json';
        $outputPath = $tempDir . '/FEMA_23R_EDF_Declaration_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $invoice->invoice_number) . '_' . time() . '.xlsx';
        $templatePath = storage_path('app/templates/fema_23r_services_declaration_template.xlsx');

        File::put($jsonPath, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $scriptPath = base_path('scripts/generate_fema_declaration.py');

        $process = new Process(['python3', $scriptPath, $jsonPath, $outputPath, $templatePath]);
        $process->setTimeout(30);
        $process->run();

        // Clean up temporary JSON input
        if (File::exists($jsonPath)) {
            File::delete($jsonPath);
        }

        if (!$process->isSuccessful() || !File::exists($outputPath)) {
            throw new \RuntimeException('FEMA Declaration generation failed: ' . $process->getErrorOutput() . ' ' . $process->getOutput());
        }

        return $outputPath;
    }
}

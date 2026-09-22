<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Invoice extends Model
{
    use HasFactory, HasUuids;

    // Use UUID as primary key
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'client_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'currency_code',
        'currency_symbol',
        'subtotal',
        'tax_amount',
        'grand_total',
        'notes',
        'bank_notes',
        'status',
        'emailed_to',
        'emailed_at',
        'type',
        'reminder_sent_at',
        'reminder_count',
        'exchange_rate_inr',
        'inr_equivalent',
        'firc_number',
        'actual_exchange_rate',
        'actual_inr_received',
        'foreign_currency',
        'foreign_amount',
        'exchange_rate_invoice',
        'inr_amount_invoice',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'emailed_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
        'reminder_count' => 'integer',
        'exchange_rate_inr' => 'decimal:6',
        'inr_equivalent' => 'decimal:2',
        'actual_exchange_rate' => 'decimal:6',
        'actual_inr_received' => 'decimal:2',
        'foreign_currency' => 'string',
        'foreign_amount' => 'decimal:2',
        'exchange_rate_invoice' => 'decimal:6',
        'inr_amount_invoice' => 'decimal:2',
    ];

    /**
     * Model Boot Hook for synchronization
     */
    protected static function booted()
    {
        static::saving(function ($invoice) {
            $invoice->foreign_currency = $invoice->currency_code;
            $invoice->foreign_amount = $invoice->grand_total;
            $invoice->exchange_rate_invoice = $invoice->exchange_rate_inr;
            $invoice->inr_amount_invoice = $invoice->inr_equivalent;
        });
    }

    /**
     * Get the user that owns this invoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the client associated with this invoice.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the line items for this invoice.
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Get the payment receipt associated with this invoice.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

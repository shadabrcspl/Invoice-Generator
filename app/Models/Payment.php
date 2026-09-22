<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Payment extends Model
{
    use HasFactory, HasUuids;

    // Use UUID as primary key
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'invoice_id',
        'payment_date',
        'exchange_rate_payment',
        'inr_amount_received',
        'forex_gain_loss',
        'firc_number',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'exchange_rate_payment' => 'decimal:6',
        'inr_amount_received' => 'decimal:2',
        'forex_gain_loss' => 'decimal:2',
    ];

    /**
     * Get the invoice associated with this payment.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

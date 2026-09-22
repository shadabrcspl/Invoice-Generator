<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'item_name',
        'description',
        'sac_code',
        'qty',
        'rate',
        'tax_percent',
        'total',
    ];

    protected $casts = [
        'qty' => 'decimal:2',
        'rate' => 'decimal:2',
        'tax_percent' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Get the invoice that owns this line item.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

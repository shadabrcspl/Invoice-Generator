<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expense_date',
        'vendor_name',
        'vendor_gstin',
        'category',
        'base_amount',
        'cgst',
        'sgst',
        'igst',
        'total_amount',
        'payment_mode',
        'is_itc_eligible',
        'receipt_url',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'base_amount' => 'decimal:2',
        'cgst' => 'decimal:2',
        'sgst' => 'decimal:2',
        'igst' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'is_itc_eligible' => 'boolean',
    ];

    /**
     * Get the user that owns the expense.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

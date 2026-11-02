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
        'is_recurring',
        'recurring_frequency',
        'recurring_next_date',
        'recurring_end_date',
        'recurring_parent_id',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'base_amount' => 'decimal:2',
        'cgst' => 'decimal:2',
        'sgst' => 'decimal:2',
        'igst' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'is_itc_eligible' => 'boolean',
        'is_recurring' => 'boolean',
        'recurring_next_date' => 'date',
        'recurring_end_date' => 'date',
    ];

    /**
     * Get the user that owns the expense.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the template/parent expense this recurring record was created from.
     */
    public function recurringParent(): BelongsTo
    {
        return $this->belongsTo(Expense::class, 'recurring_parent_id');
    }

    /**
     * Get recurring instances generated from this template expense.
     */
    public function recurringInstances()
    {
        return $this->hasMany(Expense::class, 'recurring_parent_id');
    }

    /**
     * Scope for recurring templates.
     */
    public function scopeRecurring($query)
    {
        return $query->where('is_recurring', true);
    }
}

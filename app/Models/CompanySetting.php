<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'logo',
        'email',
        'phone',
        'address',
        'gst_number',
        'website',
        'signature',
        'bank_notes',
        'lut_number',
    ];

    /**
     * Get the user that owns this company setting.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper to get the absolute logo URL or fallback.
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::url($this->logo) : asset('images/default-logo.png');
    }

    /**
     * Helper to get the absolute signature URL or fallback.
     */
    public function getSignatureUrlAttribute()
    {
        return $this->signature ? Storage::url($this->signature) : null;
    }
}

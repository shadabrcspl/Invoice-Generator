<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'gst_number',
    ];

    /**
     * Boot function to automatically generate UUIDs on creation.
     */
    protected static function booted()
    {
        static::creating(function ($client) {
            $client->uuid = (string) Str::uuid();
        });
    }

    /**
     * Get the user that owns this client.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the invoices associated with this client.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}

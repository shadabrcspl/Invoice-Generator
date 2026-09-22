<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class EmailSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
        'mail_from_name',
        'is_verified',
        'last_tested_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'last_tested_at' => 'datetime',
        'mail_port' => 'integer',
    ];

    // ---------------------------------------------------------
    // Encrypt password on save, decrypt on read
    // ---------------------------------------------------------
    public function setMailPasswordAttribute(string $value): void
    {
        $this->attributes['mail_password'] = Crypt::encryptString($value);
    }

    public function getMailPasswordAttribute(?string $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return '';
        }
    }

    // ---------------------------------------------------------
    // Relationships
    // ---------------------------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

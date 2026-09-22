<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the company settings for the user.
     */
    public function companySetting()
    {
        return $this->hasOne(CompanySetting::class);
    }

    /**
     * Get the clients owned by the user.
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Get the invoices owned by the user.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the expenses owned by the user.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Get the custom email SMTP setting for the user.
     */
    public function emailSetting()
    {
        return $this->hasOne(EmailSetting::class);
    }



    /**
     * Check if the user is the administrator.
     */
    public function isAdmin(): bool
    {
        return $this->email === 'shadabcse2020@gmail.com';
    }

    /**
     * Check if the user registration is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved' || $this->isAdmin();
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (User $user) {
            $defaults = [
                ['code' => 'USD', 'symbol' => '$'],
                ['code' => 'AUD', 'symbol' => 'A$'],
                ['code' => 'CAD', 'symbol' => 'C$'],
                ['code' => 'AED', 'symbol' => 'د.إ'],
            ];

            foreach ($defaults as $curr) {
                \App\Models\Currency::create([
                    'user_id'   => $user->id,
                    'code'      => $curr['code'],
                    'symbol'    => $curr['symbol'],
                    'is_active' => true,
                ]);
            }
        });
    }
}

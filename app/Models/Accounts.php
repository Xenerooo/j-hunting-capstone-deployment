<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Accounts extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';

    protected $fillable = [
        'email',
        'password',
        'user_type',
        'verify_token',
        'is_active',
        'is_verified',
        'is_approved',
        'is_reported',
        'logged_in_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function job_seeker(): HasOne
    {
        return $this->hasOne(JobSeeker::class, 'account_id', 'account_id');
    }

    public function employer(): HasOne
    {
        return $this->hasOne(Employer::class, 'account_id', 'account_id');
    }

    public function sent_notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'sender_id', 'account_id');
    }

    public function received_notifications(): BelongsToMany
    {
        return $this->belongsToMany(
            Notification::class,
            'notify_user',
            'account_id',
            'notif_id',
            'account_id',
            'notif_id'
        );
    }

    public function direct_notifications()
    {
        return $this->hasMany(Notification::class, 'receiver_id', 'account_id');
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class, 'account_id', 'account_id');
    }
}

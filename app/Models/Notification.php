<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'job_id',
        'sender_role',
        'receiver_role',
        'notif_title',
        'notif_content',
        'received_at',
    ];
    protected $primaryKey = 'notif_id';
    protected $table = 'notification';

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Accounts::class, 'sender_id', 'account_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Accounts::class, 'receiver_id', 'account_id');
    }

    public function recipients()
    {
        return $this->belongsToMany(
            Accounts::class,
            'notify_user',
            'notif_id',
            'account_id',
            'notif_id',
            'account_id'
        );
    }
}

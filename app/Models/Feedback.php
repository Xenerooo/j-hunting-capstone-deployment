<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feedback extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbackFactory> */
    use HasFactory;

    public $timestamps = false;
    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';
    protected $fillable = [
        'account_id',
        'content',
        'rating',
        'feedback_at',
        'is_displayed',
    ];

    protected $casts = [
        'feedback_at' => 'datetime',
        'is_displayed' => 'boolean',
        'rating' => 'integer',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Accounts::class, 'account_id', 'account_id');
    }
}

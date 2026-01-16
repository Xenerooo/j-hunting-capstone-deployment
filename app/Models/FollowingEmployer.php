<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FollowingEmployer extends Model
{
    /** @use HasFactory<\Database\Factories\FollowingEmployerFactory> */
    use HasFactory;

    public $timestamps = false;
    protected $table = 'following_employer';
    protected $primaryKey = 'seeker_follow_id';
    protected $fillable = ['seeker_id', 'employer_id', 'get_notified', 'followed_at'];

    public function job_seeker(): BelongsTo
    {
        return $this->belongsTo(JobSeeker::class, 'seeker_id', 'seeker_id');
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'employer_id');
    }
}

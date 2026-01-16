<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowingJobSeeker extends Model
{
    /** @use HasFactory<\Database\Factories\FollowingJobSeekerFactory> */
    use HasFactory;

    public $timestamps = false;
    protected $table = 'following_job_seeker';
    protected $primaryKey = 'emp_follow_id';
    protected $fillable = ['seeker_id', 'employer_id', 'followed_at'];

    public function job_seeker(): BelongsTo
    {
        return $this->belongsTo(JobSeeker::class, 'seeker_id', 'seeker_id');
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'employer_id');
    }
}

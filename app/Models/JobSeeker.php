<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobSeeker extends Model
{
    /** @use HasFactory<\Database\Factories\JobSeerkerFactory> */
    use HasFactory;

    protected $table = 'job_seeker';
    protected $primaryKey = 'seeker_id';

    protected $fillable = [
        'account_id',
        'profile_pic',
        'first_name',
        'mid_name',
        'last_name',
        'suffix',
        'job_type',
        'expertise',
        'phone_num',
        'birthday',
        'sex',
        'age',
        'experience',
        'barangay',
        'city',
        'education',
        'resume',
        'about',
        'facebook_link',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Accounts::class, 'account_id', 'account_id');
    }

    public function applied(): HasMany
    {
        return $this->hasMany(AppliedJob::class, 'seeker_id', 'seeker_id');
    }

    public function followers(): HasMany
    {
        return $this->hasMany(FollowingJobSeeker::class, 'seeker_id', 'seeker_id');
    }

    public function following(): HasMany
    {
        return $this->hasMany(FollowingEmployer::class, 'seeker_id', 'seeker_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'seeker_id', 'seeker_id');
    }

    public function portfolio(): HasMany
    {
        return $this->hasMany(Portfolio::class, 'seeker_id', 'seeker_id');
    }

    public function interview(): HasMany
    {
        return $this->hasMany(Interview::class, 'seeker_id', 'seeker_id');
    }

    public function jobTypes(): HasMany
    {
        return $this->hasMany(JobType::class, 'seeker_id', 'seeker_id');
    }
}

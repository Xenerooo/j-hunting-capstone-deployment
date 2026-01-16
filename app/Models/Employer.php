<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employer extends Model
{
    use HasFactory;

    protected $table = 'employer';
    protected $primaryKey = 'employer_id';
    protected $fillable = [
        'account_id',
        'profile_pic',
        'first_name',
        'mid_name',
        'last_name',
        'suffix',
        'employer_type',
        'comp_name',
        'phone_num',
        'date_founded',
        'barangay',
        'city',
        'work_location',
        'latitude',
        'longitude',
        'job_type',
        'about',
        'business_permit',
        'valid_id_type',
        'valid_id',
        'comp_size',
        'facebook_link'
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'employer_id', 'employer_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Accounts::class, 'account_id', 'account_id');
    }

    public function followers(): HasMany
    {
        return $this->hasMany(FollowingEmployer::class, 'employer_id', 'employer_id');
    }

    public function interview(): HasMany
    {
        return $this->hasMany(Interview::class, 'employer_id', 'employer_id');
    }

    public function following(): BelongsTo
    {
        return $this->belongsTo(FollowingJobSeeker::class, 'seeker_id', 'seeker_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'employer_id', 'employer_id');
    }

    public function jobTypes(): HasMany
    {
        return $this->hasMany(JobType::class, 'employer_id', 'employer_id');
    }
}

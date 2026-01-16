<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $table = 'jobs';
    protected $primaryKey = 'job_id';
    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'job_type',
        'employment_type',
        'experience_level',
        'expected_salary',
        'salary_basis',
        'education_level',
        'job_photo',
        'location',
        'latitude',
        'longitude',
        'max_applicant',
        'hired_applicant',
        'is_available',
        'is_reported',
        'is_approved',
        'deadline_at',
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'employer_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'job_id', 'job_id');
    }

    public function applied_jobs(): HasMany
    {
        return $this->hasMany(AppliedJob::class, 'job_id', 'job_id');
    }

    public function interview(): HasMany
    {
        return $this->hasMany(Interview::class, 'job_id', 'job_id');
    }

    public function jobTypes(): HasMany
    {
        return $this->hasMany(JobType::class, 'job_id', 'job_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppliedJob extends Model
{
    /** @use HasFactory<\Database\Factories\AppliedJobFactory> */
    use HasFactory;

    public $timestamps = false;
    protected $table = 'applied_jobs';
    protected $primaryKey = 'applied_id';
    protected $fillable = ['seeker_id', 'employer_id', 'job_id', 'status', 'applied_date'];

    public function job_seeker(): BelongsTo
    {
        return $this->belongsTo(JobSeeker::class, 'seeker_id', 'seeker_id');
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'employer_id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }
}

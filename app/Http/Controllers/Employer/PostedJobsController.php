<?php

namespace App\Http\Controllers\Employer;

use App\Models\Job;
use App\Models\Employer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostedJobsController extends Controller
{
    //get posted jobs
    public function getPostedJobs(Request $request)
    {
        $account_id = Auth::id();
        $employer_id = Employer::where('account_id', $account_id)->value('employer_id');

        $query = Job::with(['employer', 'jobTypes'])->where('employer_id', $employer_id);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        switch ($request->sort) {
            case 'newest':
                $query->orderByDesc('created_at');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'pending':
                $query->where('status', 'pending');
                break;
            case 'accepted':
                $query->where('status', 'accepted');
                break;
            case 'rejected':
                $query->where('status', 'rejected');
                break;
            case 'restricted':
                $query->where('status', 'restricted');
                break;
            case 'expired':
                $query->where('deadline_at', '<', now());
                break;
            default:
                $query->orderByDesc('created_at');
                break;
        }

        $jobs = $query->get();

        if ($jobs->isEmpty()) {
            return response()->json([
                'message' => 'No job found.',
                'data' => [],
            ]);
        }

        $details = $jobs->map(function ($job) {
            $types = $job->jobTypes?->pluck('job_type')->toArray() ?? [];
            $job_array = $job->toArray();
            $job_array['job_types'] = $types;
            return $job_array;
        });

        return response()->json([
            'message' => 'Jobs found.',
            'data' => $details,
        ]);
    }

    //view job
    public function viewJob($job_id)
    {
        $job = Job::where('job_id', $job_id)->first();

        return view('design.employer.view-job', compact('job'));
    }

    //get job data
    public function getJobData(Request $request)
    {
        $job_id = $request->job_id;
        $job = Job::with('employer')->where('job_id', $job_id)->firstOrFail();
        $job_type = JobType::where('job_id', $job_id)->value('job_type');

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve job data.',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $job,
            'job_type' => $job_type,
        ]);
    }

    //view edit post
    public function viewEdit($job_id)
    {
        $job = Job::where('job_id', $job_id)->first();

        return view('design.employer.edit-job', compact('job'));
    }

    //get edit data
    public function getEditData(Request $request)
    {
        $job_id = $request->job_id;
        $job = Job::with('employer')->where('job_id', $job_id)->first();
        $job_type = JobType::where('job_id', $job_id)->value('job_type');

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'No job found.'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $job,
            'job_type' => $job_type,
        ]);
    }

    //update job data
    public function updateJobData(Request $request)
    {
        try {
            $account_id = Auth::id();
            $employer_id = Employer::where('account_id', $account_id)->value('employer_id');

            if (!$request->has('job_id')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job ID is required.',
                ]);
            }

            $job_id = $request->job_id;

            $job = Job::where('job_id', $job_id)->first();
            $db_job_type = JobType::where('job_id', $job_id)->first();

            if (!$job) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job not found.',
                ]);
            }
            if (!$db_job_type) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job type not exist.',
                ]);
            }
            if ($job->employer_id != $employer_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized to update this job.',
                ]);
            }

            $validator = Validator::make($request->all(), [
                'job_title' => ['required', 'string', 'max:70'],
                'description' => ['required', 'string', 'min:30'],
                'employment_type' => ['required', 'string'],
                'experience' => ['nullable', 'string', 'max:20'],
                'salary' => ['required', 'numeric', 'min:0', 'max:999999.99'],
                'salary_basis' => ['required', 'string'],
                'qualification' => ['required', 'string', 'max:100'],
                'job_photo' => ['nullable', 'image', File::image()->max(2 * 1024)],
                'location' => ['required', 'string', 'max:140'],
                'latitude' => ['required', 'numeric', 'between:-90,90'],
                'longitude' => ['required', 'numeric', 'between:-180,180'],
                'max_applicant' => ['required', 'integer', 'min:1'],
                'expiration_date' => ['required', 'date', 'after:today'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $validated = $validator->validated();

            $job_type = $request->job_type;
            if (empty($job_type)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please select a job type.',
                ]);
            }

            if (
                $request->hasFile('job_photo') &&
                $job->job_photo &&
                Storage::disk('public')->exists($job->job_photo)
            ) {
                Storage::disk('public')->delete($job->job_photo);
            }

            $job_photo_path = $job->job_photo;

            if ($request->hasFile('job_photo')) {
                $jobPhotoFile = $request->file('job_photo');
                $originalName = $jobPhotoFile->getClientOriginalName();
                $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $jobPhotoFile->getClientOriginalExtension();
                $job_photo_path = $jobPhotoFile->storeAs('job-photo', $filename, 'public');
            }

            $data = [
                'employer_id' => $employer_id,
                'title' => $validated['job_title'],
                'description' => $validated['description'],
                'employment_type' => $validated['employment_type'],
                'experience_level' => $validated['experience'],
                'expected_salary' => $validated['salary'],
                'salary_basis' => $validated['salary_basis'],
                'education_level' => $validated['qualification'],
                'location' => $validated['location'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'max_applicant' => $validated['max_applicant'],
                'deadline_at' => $validated['expiration_date'],
            ];

            if ($job_photo_path) $data['job_photo'] = $job_photo_path;

            $update_job_type = [
                'seeker_id' => null,
                'employer_id' => null,
                'job_id' => $job->job_id,
                'job_type' => $job_type,
            ];

            $job->update($data);
            $db_job_type->update($update_job_type);

            return response()->json([
                'success' => true,
                'message' => 'Job updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    //delete job post
    public function deleteJob(Request $request)
    {
        try {
            if (!$request->has('job_id')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job ID is required.',
                ]);
            }

            $job_id = $request->job_id;

            $job = Job::find($job_id);

            if (!$job) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job not found.'
                ]);
            }

            if ($job->job_photo && Storage::disk('public')->exists($job->job_photo)) {
                Storage::disk('public')->delete($job->job_photo);
            }

            $job->delete();

            JobType::where('job_id', $job_id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Job was deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Deletion of the job was unsuccessful. ' . $e->getMessage()
            ]);
        }
    }

    //get all jobs and update to unavailable when expired
    public function getJobsAndUpdateUnavailable()
    {
        $expired_jobs = Job::where('deadline_at', '<', now())
            ->update([
                'is_available' => 0,
                'status' => 'expired'
            ]);

        $full_jobs = Job::whereColumn('hired_applicant', '=', 'max_applicant')->update([
            'is_available' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => $expired_jobs > 0 ? 'Jobs updated successfully' : 'No jobs needed updating',
            'updated_count' => $expired_jobs,
            'updated_full_jobs' => $full_jobs,
        ]);
    }
}

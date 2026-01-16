<?php

namespace App\Http\Controllers\Employer;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Employer;
use App\Models\JobSeeker;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\FollowingEmployer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;

class PostJobController extends Controller
{
    //get employer data
    public function getEmployerData()
    {
        $account_id = Auth::id();
        $employer_data = Employer::where('account_id', $account_id)->first();

        if (!$employer_data) {
            return response()->json([
                'message' => 'Employer not found',
            ]);
        }

        return response()->json([
            'data' => $employer_data,
        ]);
    }

    //post job
    public function postJob(Request $request)
    {
        try {
            $account_id = Auth::id();
            $employer = Employer::where('account_id', $account_id)->first();

            $validator = Validator::make($request->all(), [
                'job_title' => ['required', 'string', 'max:70'],
                'description' => ['required', 'string', 'min:30'],
                'employment_type' => ['required', 'string'],
                'experience' => ['required', 'string', 'max:20'],
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

            $job_photo_path = null;

            if ($request->hasFile('job_photo')) {
                $jobPhotoFile = $request->file('job_photo');
                $originalName = $jobPhotoFile->getClientOriginalName();
                $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $jobPhotoFile->getClientOriginalExtension();
                $job_photo_path = $jobPhotoFile->storeAs('job-photo', $filename, 'public');
            }

            $data = [
                'employer_id' => $employer->employer_id,
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

            $job = Job::create($data);

            JobType::where('job_id', $job->job_id)->delete();

            JobType::create([
                'seeker_id' => null,
                'employer_id' => null,
                'job_id' => $job->job_id,
                'job_type' => $job_type,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Job posted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

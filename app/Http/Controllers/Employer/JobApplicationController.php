<?php

namespace App\Http\Controllers\Employer;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Employer;
use App\Models\Interview;
use App\Models\JobSeeker;
use App\Models\AppliedJob;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class JobApplicationController extends Controller
{
    //get all job applications
    public function getApplication(Request $request)
    {

        $account_id = Auth::id();
        $employer_id = Employer::where('account_id', $account_id)->value('employer_id');

        $query = AppliedJob::with('job_seeker', 'job')->where('employer_id', $employer_id);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->whereHas('job_seeker', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('mid_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', mid_name, ' ', last_name)"), 'like', "%{$search}%");
            });
        }

        switch ($request->sort) {
            case 'newest':
                $query->orderBy('applied_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('applied_at', 'asc');
                break;
            case 'pending':
                $query->where('status', 'pending');
                break;
            case 'accepted':
                $query->where('status', 'accepted');
                break;
            case 'interview':
                $query->where('status', 'interview');
                break;
            case 'rejected':
                $query->where('status', 'rejected');
                break;
            default:
                $query->orderBy('applied_at', 'desc');
                break;
        }

        $result = $query->get();

        if ($result->isEmpty()) {
            return response()->json([
                'message' => 'No Applicant found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Applicant found.',
            'applicants' => $result->map(function ($seeker) {
                $jobSeeker = $seeker->job_seeker;
                $job = $seeker->job;
                return [
                    'seeker_id' => $jobSeeker->seeker_id ?? null,
                    'job_id' => $job->job_id ?? null,
                    'profile_pic' => $jobSeeker->profile_pic ?? null,
                    'first_name' => $jobSeeker->first_name ?? null,
                    'mid_name' => $jobSeeker->mid_name ?? null,
                    'last_name' => $jobSeeker->last_name ?? null,
                    'suffix' => $jobSeeker->suffix ?? null,
                    'job_type' => $jobSeeker->job_type ?? null,
                    'barangay' => $jobSeeker->barangay,
                    'city' => $jobSeeker->city,
                    'title' => $job->title,
                    'status' => $seeker->status,
                    'applied_at' => $seeker->applied_at,
                ];
            }),
        ]);
    }

    //view job seeker
    public function viewJobSeeker($seeker_id, $job_id)
    {
        $job = $job_id;
        $seeker = JobSeeker::find($seeker_id);
        return view('design.employer.view-applicant', compact('seeker', 'job'));
    }

    //view job
    public function viewJob($job_id)
    {
        $job = Job::find($job_id);
        return view('design.employer.view-job', compact('job'));
    }

    //get applicant data
    public function getApplicantData(Request $request)
    {
        $seeker_id = $request->input('seeker_id');
        $seeker = JobSeeker::with('account', 'portfolio')->where('seeker_id', $seeker_id)->firstOrFail();
        $job_types = JobType::where('seeker_id', $seeker_id)->pluck('job_type');

        return response()->json([
            'success' => true,
            'data' => $seeker,
            'job_type' => $job_types,
            'portfolio' => $seeker->portfolio->map(function ($portfolio) {
                return [
                    'type' => $portfolio->type,
                    'path' => $portfolio->path,
                ];
            }),
        ]);
    }

    //check if the job seeker is not pending
    public function checkStatus(Request $request)
    {
        $account_id = Auth::id();
        $employer = Employer::where('account_id', $account_id)->first();
        $seeker_id = $request->input('seeker_id');
        $job_id = $request->input('job_id');

        if (!$employer || !$seeker_id) {
            return response()->json([
                'success' => false,
                'message' => 'Employer or seeker ID not found.',
            ], 404);
        }

        $applied_job = AppliedJob::where('seeker_id', $seeker_id)
            ->where('employer_id', $employer->employer_id)->where('job_id', $job_id)
            ->first();

        if (!$applied_job) {
            return response()->json([
                'success' => false,
                'message' => 'No application found for this job seeker.',
            ], 404);
        }

        $status = $applied_job->status;

        if ($status === 'rejected') {
            return response()->json([
                'success' => true,
                'status' => 'Rejected',
                'message' => 'The job seeker was rejected.',
            ]);
        } elseif ($status === 'accepted') {
            return response()->json([
                'success' => true,
                'status' => 'Accepted',
                'message' => 'The job seeker was accepted.',
            ]);
        } elseif ($status === 'interview') {
            return response()->json([
                'success' => true,
                'status' => 'Interview',
                'message' => 'The job seeker is scheduled for interview.',
            ]);
        } else {
            return response()->json([
                'success' => true,
                'status' => $status,
                'message' => 'The job seeker is still pending or in another status.',
            ]);
        }
    }

    //accept application
    public function acceptApplicant(Request $request)
    {
        $account_id = Auth::id();
        $employer_data = Employer::where('account_id', $account_id)->first();
        $seeker_id = $request->seeker_id;
        $job_id = $request->job_id;
        $action = $request->action;
        $seeker_data = JobSeeker::where('seeker_id', $seeker_id)->first();

        if (!$employer_data || !$seeker_data) {
            return response()->json([
                'success' => false,
                'message' => 'Employer or job seeker not found.',
            ], 404);
        }

        $applied_job = AppliedJob::where('seeker_id', $seeker_id)
            ->where('employer_id', $employer_data->employer_id)->where('job_id', $job_id)
            ->first();

        if (!$applied_job) {
            return response()->json([
                'success' => false,
                'message' => 'Applied job not found.',
            ], 404);
        }

        $job = Job::where('job_id', $applied_job->job_id)->value('title');

        try {
            if ($action === 'interview') {

                $request->validate([
                    'interview_date' => ['required'],
                    'mode' => ['required'],
                    'detail' => ['required', 'max:255'],
                ]);

                $interview_date_raw = $request->interview_date;
                $interview_date = Carbon::parse($interview_date_raw)->format('M d, Y');
                $mode = $request->mode;
                $detail = $request->detail;

                $notif_title = "Get Ready for the interview!";
                $notif_content = "{$seeker_data->first_name}, you are invited to an interview on {$interview_date}. Please check your Job Interview page for details.";

                $applied_job->update(['status' => 'interview']);

                Interview::create([
                    'employer_id' => $employer_data->employer_id,
                    'seeker_id' => $seeker_id,
                    'job_id' => $job_id,
                    'interview_date' => $interview_date_raw,
                    'mode' => $mode,
                    'detail' => $detail
                ]);

                Notification::create([
                    'sender_id' => $account_id,
                    'sender_role' => 'employer',
                    'receiver_id' => $seeker_data->account_id,
                    'receiver_role' => 'job_seeker',
                    'notif_title' => $notif_title,
                    'notif_content' => $notif_content,
                    'recieved_at' => now(),
                ]);
            } else {

                $current_applied = Job::where('job_id', $job_id)->first();

                if (!$current_applied) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Job not found.',
                    ], 404);
                }

                $applied_count = $current_applied->hired_applicant ?? 0;
                $max_application = $current_applied->max_applicant ?? 0;

                if ($max_application > 0 && $applied_count >= $max_application) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The maximum number of hired applicants for this job has been reached.',
                    ], 400);
                }

                Job::where('job_id', $job_id)->update(['hired_applicant' => $applied_count + 1]);

                $notif_title = "You have been accepted for the job";
                $notif_content = "Congratulations! {$seeker_data->first_name}, we are pleased to inform you that you have been accepted for the position {$job}.";

                $applied_job->update(['status' => 'accepted']);

                Notification::create([
                    'sender_id' => $account_id,
                    'sender_role' => 'employer',
                    'receiver_id' => $seeker_data->account_id,
                    'receiver_role' => 'job_seeker',
                    'notif_title' => $notif_title,
                    'notif_content' => $notif_content,
                    'recieved_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => "The job seeker was accepted successfully.",
            ]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json([
                'success' => false,
                'message' => $errors[0] ?? 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    //reject application
    public function rejectApplicant(Request $request)
    {
        try {
            $account_id = Auth::id();
            $employer_data = Employer::where('account_id', $account_id)->first();
            $seeker_id = $request->seeker_id;
            $job_id = $request->job_id;
            $seeker_data = JobSeeker::where('seeker_id', $seeker_id)->first();

            if (!$employer_data || !$seeker_data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employer or job seeker not found.',
                ], 404);
            }

            $applied_job = AppliedJob::where('seeker_id', $seeker_id)
                ->where('employer_id', $employer_data->employer_id)->where('job_id', $job_id)
                ->first();

            if (!$applied_job) {
                return response()->json([
                    'success' => false,
                    'message' => 'Applied job not found.',
                ], 404);
            }

            $job = Job::where('job_id', $applied_job->job_id)->value('title');

            $notif_title = "You have been rejected for the job";
            $notif_content = "We regret to inform you, {$seeker_data->first_name}, that you have not been selected for the position {$job}. Thank you for your interest and we wish you the best in your job search.";

            $applied_job->update(['status' => 'rejected']);

            Notification::create([
                'sender_id' => $account_id,
                'sender_role' => 'employer',
                'receiver_id' => $seeker_data->account_id,
                'receiver_role' => 'job_seeker',
                'notif_title' => $notif_title,
                'notif_content' => $notif_content,
                'recieved_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => "The job seeker was rejected successfully.",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    //delete applicant
    public function deleteApplicant(Request $request)
    {
        $seeker_id = $request->input('seeker_id');
        $job_id = $request->input('job_id');

        if (!$seeker_id || !$job_id) {
            return response()->json([
                'success' => false,
                'message' => 'Seeker ID or Job ID not provided.'
            ], 400);
        }

        $applicant = AppliedJob::where('seeker_id', $seeker_id)
            ->where('job_id', $job_id)
            ->first();

        if (!$applicant) {
            return response()->json([
                'success' => false,
                'message' => 'Applicant not found.'
            ], 404);
        }

        $applicant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Applicant was deleted successfully.'
        ]);
    }
}

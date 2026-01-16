<?php

namespace App\Http\Controllers\Employer;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Interview;
use App\Models\JobSeeker;
use App\Models\AppliedJob;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InteviewController extends Controller
{
    //get all interview
    public function getScheduled(Request $request)
    {
        $account_id = Auth::id();
        $employer_id = Employer::where('account_id', $account_id)->value('employer_id');

        $query = Interview::with('job_seeker', 'job')
            ->where('employer_id', $employer_id);

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
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        if ($request->filled('sort_date')) {
            $date = $request->input('sort_date');
            $query->whereDate('interview_date', '=', $date);
        }

        $result = $query->get();

        if ($result->isEmpty()) {
            return response()->json([
                'message' => 'No job seeker found.',
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'Job seeker found.',
            'data' => $result->map(function ($seeker) {
                $jobSeeker = $seeker->job_seeker;
                $job = $seeker->job;
                return [
                    'interview_id' => $seeker->interview_id ?? null,
                    'seeker_id' => $jobSeeker->seeker_id ?? null,
                    'job_id' => $job->job_id ?? null,
                    'profile_pic' => $jobSeeker->profile_pic ?? null,
                    'first_name' => $jobSeeker->first_name ?? null,
                    'mid_name' => $jobSeeker->mid_name ?? null,
                    'last_name' => $jobSeeker->last_name ?? null,
                    'suffix' => $jobSeeker->suffix ?? null,
                    'job_type' => $jobSeeker->job_type ?? null,
                    'barangay' => $jobSeeker->barangay,
                    'city' => $jobSeeker->city ?? null,
                    'title' => $job->title ?? null,
                    'status' => $seeker->status ?? null,
                    'interview_date' => $seeker->interview_date ?? null,
                ];
            }),
        ]);
    }

    //get inteview details
    public function getInteviewDetails(Request $request)
    {
        $interview_id = $request->interview_id;

        if (!$interview_id) {
            return response()->json([
                'success' => false,
                'message' => 'Interview ID is required.'
            ]);
        }

        $interview_details = Interview::where('interview_id', $interview_id)->first();

        if (!$interview_details) {
            return response()->json([
                'success' => false,
                'message' => 'No interview found.'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $interview_details,
        ]);
    }

    //update interview details  
    public function updateInterviewDetails(Request $request)
    {
        $interview_id = $request->interview_id;

        $interview = Interview::where('interview_id', $interview_id)->first();

        if (!$interview) {
            return response()->json([
                'success' => false,
                'message' => 'Interview not found.'
            ]);
        }

        $fieldsToUpdate = [];

        if ($request->has('status') && $request->status !== $interview->status) {
            $fieldsToUpdate['status'] = $request->status;
        }
        if ($request->has('interview_date') && $request->interview_date !== $interview->interview_date) {
            $fieldsToUpdate['interview_date'] = $request->interview_date;
        }
        if ($request->has('mode') && $request->mode !== $interview->mode) {
            $fieldsToUpdate['mode'] = $request->mode;
        }
        if ($request->has('detail') && $request->detail !== $interview->detail) {
            $fieldsToUpdate['detail'] = $request->detail;
        }

        if (empty($fieldsToUpdate)) {
            return response()->json([
                'success' => false,
                'message' => 'No changes detected to update.'
            ]);
        }

        $updated = $interview->update($fieldsToUpdate);

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to update the interview details.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Interview details has been updated successfully.'
        ]);
    }

    //change the applicant status
    public function changeApplicantStatus(Request $request)
    {

        $account_id = Auth::id();
        $employer_data = Employer::where('account_id', $account_id)->first();
        $seeker_id = $request->seeker_id;
        $job_id = $request->job_id;
        $is_accepted = $request->is_accepted;
        $seeker_data = JobSeeker::where('seeker_id', $seeker_id)->first();

        if (!$employer_data || !$seeker_data || !$job_id || !$seeker_id) {
            return response()->json([
                'success' => false,
                'message' => 'Could not process the request, required data not found.'
            ]);
        }

        $applied_job = AppliedJob::where('seeker_id', $seeker_id)
            ->where('employer_id', $employer_data->employer_id)
            ->where('job_id', $job_id)
            ->first();

        if (!$applied_job) {
            return response()->json([
                'success' => false,
                'message' => 'Applied job not found.',
            ], 404);
        }

        $job = Job::where('job_id', $applied_job->job_id)->value('title');
        $delete_interview = Interview::where('seeker_id', $seeker_id)
            ->where('job_id', $job_id);

        try {
            if ($is_accepted === "true") {
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

                if ($applied_job->status !== 'accepted') {
                    Job::where('job_id', $job_id)->update(['hired_applicant' => $applied_count + 1]);
                }

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

                $delete_interview->delete();
            } else {
                $notif_title = "You have been rejected for the job";
                $notif_content = "We regret to inform you, {$seeker_data->first_name}, that you have not been selected for the position {$job}. Thank you for your interest and we wish you the best in your job search.";

                if ($applied_job->status !== 'rejected') {
                    $applied_job->update(['status' => 'rejected']);
                }

                Notification::create([
                    'sender_id' => $account_id,
                    'sender_role' => 'employer',
                    'receiver_id' => $seeker_data->account_id,
                    'receiver_role' => 'job_seeker',
                    'notif_title' => $notif_title,
                    'notif_content' => $notif_content,
                    'recieved_at' => now(),
                ]);

                $delete_interview->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Applicant status was updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

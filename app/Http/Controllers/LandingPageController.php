<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Employer;
use App\Models\Feedback;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('design.home.index');
    }

    public function newJobs()
    {
        $jobs = Job::with('employer.account')
            ->where('status', 'accepted')
            ->where('is_available', 1)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('design.home.new-jobs', compact('jobs'));
    }

    public function newEmployers()
    {
        $employers = Employer::with('account')
            ->whereHas('account', function ($query) {
                $query->where('is_approved', 1);
            })
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        return view('design.home.new-employers', compact('employers'));
    }

    public function about()
    {
        return view('design.home.about');
    }

    public function feedback()
    {
        $feedbacks = Feedback::with(['account.job_seeker', 'account.employer'])
            ->where('is_displayed', 1)
            ->orderBy('feedback_at', 'desc')
            ->take(20)
            ->get()
            ->map(function ($feedback) {
                $account = $feedback->account;
                $user = null;

                if ($account) {
                    if ($account->user_type === 'job_seeker' && $account->job_seeker) {
                        $user = (object) [
                            'name' => $account->job_seeker->first_name . ' ' . $account->job_seeker->last_name,
                            'profile_picture' => $account->job_seeker->profile_pic,
                            'role' => 'job_seeker',
                            'job_title' => 'Job Seeker'
                        ];
                    } elseif ($account->user_type === 'employer' && $account->employer) {
                        $user = (object) [
                            'name' => $account->employer->first_name . ' ' . $account->employer->last_name ?? 'Employer',
                            'profile_picture' => $account->employer->profile_pic,
                            'role' => 'employer',
                            'company_name' => 'Employer'
                        ];
                    }
                }

                $feedback->user = $user;
                return $feedback;
            });

        return view('design.home.feedback', compact('feedbacks'));
    }
}

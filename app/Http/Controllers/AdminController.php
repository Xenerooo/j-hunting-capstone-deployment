<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('design.admin.dashboard');
    }

    public function jobSeekers()
    {
        return view('design.admin.all-job-seeker');
    }

    public function viewJobSeeker()
    {
        return view('design.admin.view-seeker');
    }

    public function employers()
    {
        return view('design.admin.all-employer');
    }

    public function viewEmployer()
    {
        return view('design.admin.view-employer');
    }

    public function jobs()
    {
        return view('design.admin.all-jobs');
    }

    public function viewJobs()
    {
        return view('design.admin.view-job');
    }

    public function requestJob()
    {
        return view('design.admin.request-job');
    }

    public function viewRequestJob()
    {
        return view('design.admin.view-requested-job');
    }

    public function requestJobSeeker()
    {
        return view('design.admin.request-seeker');
    }

    public function requestEmployer()
    {
        return view('design.admin.request-employer');
    }

    public function reportedJobs()
    {
        return view('design.admin.reported-job');
    }

    public function repotedJobSeekers()
    {
        return view('design.admin.reported-seeker');
    }

    public function reportedEmployers()
    {
        return view('design.admin.reported-employer');
    }

    public function feedback()
    {
        return view('design.admin.feedback');
    }

    public function settings()
    {
        return view('design.admin.settings');
    }
}

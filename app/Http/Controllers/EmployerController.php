<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController
{
    public function dashboard()
    {
        return view('design.employer.dashboard');
    }

    public function post()
    {
        return view('design.employer.new-job');
    }

    public function posted()
    {
        return view('design.employer.posted-jobs');
    }

    public function application()
    {
        return view('design.employer.application');
    }

    public function interview()
    {
        return view('design.employer.interview');
    }

    public function following()
    {
        return view('design.employer.following');
    }

    public function notification()
    {
        return view('design.employer.notification');
    }

    public function profile()
    {
        return view('design.employer.profile');
    }

    public function settings()
    {
        return view('design.employer.settings');
    }

    public function viewSeeker()
    {
        return view('design.employer.view-seeker');
    }

    public function viewApplicant()
    {
        return view('design.employer.view-applicant');
    }

    public function viewJob()
    {
        return view('design.employer.view-job');
    }

    public function editJob()
    {
        return view('design.employer.edit-job');
    }
}

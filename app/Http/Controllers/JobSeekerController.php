<?php

namespace App\Http\Controllers;

class JobSeekerController
{
    public function dashboard()
    {
        return view('design.seeker.dashboard');
    }

    public function applied()
    {
        return view('design.seeker.applied');
    }

    public function interview()
    {
        return view('design.seeker.interview');
    }

    public function notification()
    {
        return view('design.seeker.notification');
    }

    public function following()
    {
        return view('design.seeker.following');
    }

    public function profile()
    {
        return view('design.seeker.profile');
    }

    public function settings()
    {
        return view('design.seeker.settings');
    }

    public function viewJob()
    {
        return view('design.seeker.view-job');
    }

    public function viewEmployer()
    {
        return view('design.seeker.view-employer');
    }
}

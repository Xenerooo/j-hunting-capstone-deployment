<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Accounts;
use App\Models\JobSeeker;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FollowingEmployer;
use App\Models\FollowingJobSeeker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Portfolio;
use App\Models\JobType;

class ProfileController extends Controller
{
    //get profile data
    public function getData()
    {
        $userID = Auth::id();

        $accountDetails = Accounts::where('account_id', $userID)->where('user_type', 'job_seeker')->first();

        if (!$accountDetails) {
            return redirect()->route('index');
        }

        $seekerProfile = JobSeeker::with('portfolio')->where('account_id', $userID)->first();

        $followings = $seekerProfile ? FollowingEmployer::where('seeker_id', $seekerProfile->seeker_id)->count() : 0;

        $followers = $seekerProfile ? FollowingJobSeeker::where('seeker_id', $seekerProfile->seeker_id)->count() : 0;

        if (!isset($seekerProfile)) {
            return response()->json([
                'success' => false,
                'button_text' => "Create profile",
                'title' => 'No profile found.',
                'message' => 'Please create your profile by clicking the create button.',
                'account_details' => $accountDetails,
                'profile_details' => $seekerProfile,
            ]);
        }

        $jobTypes = JobType::where('seeker_id', $seekerProfile->seeker_id)->pluck('job_type')->toArray();

        return response()->json([
            'success' => true,
            'account_details' => $accountDetails,
            'profile_details' => $seekerProfile,
            'job_types' => $jobTypes,
            'followings' => $followings,
            'followers' => $followers,
            'portfolio' => $seekerProfile->portfolio,
        ]);
    }

    //get data in the Edit Profile part
    public function getProfileData()
    {
        $userID = Auth::id();
        $profile = JobSeeker::with('portfolio')->where('account_id', $userID)->first();

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found.',
            ]);
        }

        // Load job types
        $jobTypes = JobType::where('seeker_id', $profile->seeker_id)->pluck('job_type')->toArray();

        return response()->json([
            'success' => true,
            'profile' => $profile,
            'portfolio' => $profile->portfolio,
            'job_types' => $jobTypes,
        ]);
    }

    //update or create profile
    public function edit(Request $request)
    {
        try {
            $userID = Auth::id();
            $existingFile = JobSeeker::where('account_id', $userID)->first();

            // Validation rules
            $rules = [
                'add_profile_pic' => ['nullable', 'image', File::image()->max(12 * 1024)],
                'add_first_name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s-]+$/'],
                'add_mid_name'   => ['nullable', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s-]+$/'],
                'add_last_name'  => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s-]+$/'],
                'add_suffix' => ['nullable', 'string', 'min:1', 'max:3'],
                'add_birthday' => ['required', 'date'],
                'add_age' => ['required', 'integer', 'gte:18'],
                'add_sex' => ['required', 'in:male,female'],
                'add_barangay' => ['required', 'string'],
                'add_city' => ['required', 'string'],
                'add_phone_num' => ['required', 'string', 'starts_with:0', 'size:11'],
                'add_facebook_link' => ['required', 'string', 'max:255'],
                'add_expertise' => ['required', 'string', 'max:100'],
                'add_resume' => [
                    $existingFile && $existingFile->resume ? 'nullable' : 'required',
                    'file',
                    File::types(['pdf'])->max(2 * 1024)
                ],
                'add_experience' => ['nullable', 'string'],
                'add_education' => ['required', 'string'],
                'add_about' => ['nullable', 'string'],
            ];

            $request->validate($rules);

            $selectedJobTypes = [];
            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'job_type_') === 0 && !empty($value)) {
                    $selectedJobTypes[] = $value;
                }
            }

            if (empty($selectedJobTypes)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please select at least one job type.',
                ], 422);
            }

            if (
                $request->hasFile('add_profile_pic') &&
                $existingFile &&
                $existingFile->profile_pic &&
                Storage::disk('public')->exists($existingFile->profile_pic)
            ) {
                Storage::disk('public')->delete($existingFile->profile_pic);
            }

            if (
                $request->hasFile('add_resume') &&
                $existingFile &&
                $existingFile->resume &&
                Storage::disk('public')->exists($existingFile->resume)
            ) {
                Storage::disk('public')->delete($existingFile->resume);
            }

            $profilePath = null;
            $resumePath = null;

            if ($request->hasFile('add_profile_pic')) {
                $profileFile = $request->file('add_profile_pic');
                $originalName = $profileFile->getClientOriginalName();
                $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $profileFile->getClientOriginalExtension();
                $profilePath = $profileFile->storeAs('profile', $filename, 'public');
            }

            if ($request->hasFile('add_resume')) {
                $resumeFile = $request->file('add_resume');
                $originalName = $resumeFile->getClientOriginalName();
                $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $resumeFile->getClientOriginalExtension();
                $resumePath = $resumeFile->storeAs('resume', $filename, 'public');
            }

            $data = [
                'first_name' => $request->add_first_name,
                'mid_name' => $request->add_mid_name,
                'last_name' => $request->add_last_name,
                'suffix' => $request->add_suffix,
                'birthday' => $request->add_birthday,
                'age' => $request->add_age,
                'sex' => $request->add_sex,
                'barangay' => $request->add_barangay,
                'city' => $request->add_city,
                'phone_num' => $request->add_phone_num,
                'facebook_link' => $request->add_facebook_link,
                'expertise' => $request->add_expertise,
                'experience' => $request->add_experience,
                'education' => $request->add_education,
                'about' => $request->add_about
            ];

            if ($profilePath) {
                $data['profile_pic'] = $profilePath;
            }

            if ($resumePath) {
                $data['resume'] = $resumePath;
            } elseif ($existingFile && $existingFile->resume) {
                $data['resume'] = $existingFile->resume;
            }


            $data['account_id'] = $userID;
            $profile = JobSeeker::updateOrCreate(['account_id' => $userID], $data);

            JobType::where('seeker_id', $profile->seeker_id)->delete();

            foreach ($selectedJobTypes as $jobTypeValue) {
                JobType::create([
                    'seeker_id' => $profile->seeker_id,
                    'employer_id' => null,
                    'job_type' => $jobTypeValue,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Your profile was updated successfully.',
                'data' => $profile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving your profile.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function uploadPortfolio(Request $request)
    {
        $userID = Auth::id();

        $request->validate([
            'additional_file' => ['nullable', 'file', File::types(['pdf', 'docx', 'doc'])->max(2 * 1024)],
            'portfolio_link' => ['nullable', 'string', 'max:255'],
        ]);

        $seeker = JobSeeker::where('account_id', $userID)->first();

        if (!$seeker) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found.',
            ]);
        }

        if ($request->hasFile('additional_file')) {
            Portfolio::where('seeker_id', $seeker->seeker_id)
                ->where('type', 'file')
                ->delete();

            $additionalFile = $request->file('additional_file');
            $originalName = $additionalFile->getClientOriginalName();
            $filename = time() . '_' . uniqid() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $additionalFile->getClientOriginalExtension();
            $additionalPath = $additionalFile->storeAs('certificate', $filename, 'public');

            if (!$additionalPath) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to upload the file.',
                ], 422);
            }

            Portfolio::create([
                'seeker_id' => $seeker->seeker_id,
                'type' => 'file',
                'path' => $additionalPath,
            ]);
        }

        if ($request->portfolio_link) {
            Portfolio::where('seeker_id', $seeker->seeker_id)
                ->where('type', 'link')
                ->delete();

            Portfolio::create([
                'seeker_id' => $seeker->seeker_id,
                'type' => 'link',
                'path' => $request->portfolio_link,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Portfolio uploaded successfully.',
        ]);
    }
}

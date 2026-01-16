<?php

namespace App\Http\Controllers\Employer;

use App\Models\JobType;
use App\Models\Accounts;
use App\Models\Employer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FollowingEmployer;
use App\Models\FollowingJobSeeker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //get profile data
    public function getData()
    {
        //current logged in
        $userID = Auth::id();

        //user account details
        $accountDetails = Accounts::where('account_id', $userID)->where('user_type', 'employer')->first();

        if (!$accountDetails) {
            return redirect()->route('index');
        }

        $employerProfile = Employer::where('account_id', $userID)->first();

        $followings = $employerProfile ? FollowingJobSeeker::where('employer_id', $employerProfile->employer_id)->count() : 0;

        $followers = $employerProfile ? FollowingEmployer::where('employer_id', $employerProfile->employer_id)->count() : 0;

        if (!isset($employerProfile)) {
            return response()->json([
                'success' => false,
                'button_text' => "Create profile",
                'title' => 'No profile found.',
                'message' => 'Please create your profile by clicking the create button.',
                'account_details' => $accountDetails,
                'profile_details' => $employerProfile
            ]);
        }

        $jobType = JobType::where('employer_id', $employerProfile->employer_id)->value('job_type');

        return response()->json([
            'success' => true,
            'account_details' => $accountDetails,
            'profile_details' => $employerProfile,
            'job_type' => $jobType,
            'followings' => $followings,
            'followers' => $followers,
        ]);
    }

    //get data in the Edit Profile part
    public function getProfileData()
    {
        $userID = Auth::id();
        $profile = Employer::where('account_id', $userID)->first();
        $jobType = JobType::where('employer_id', $profile->employer_id)->value('job_type');

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found.',
            ]);
        }

        return response()->json([
            'success' => true,
            'profile' => $profile,
            'job_type' => $jobType,
        ]);
    }

    //update or create profile
    public function edit(Request $request)
    {
        try {
            $userID = Auth::id();

            //validate user input
            $request->validate([
                'add_profile_pic' => ['nullable', 'image', File::image()->max(2 * 1024)],
                'add_first_name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s-]+$/'],
                'add_mid_name'   => ['nullable', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s-]+$/'],
                'add_last_name'  => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s-]+$/'],
                'add_suffix' => ['nullable', 'string', 'min:1', 'max:3'],
                'add_employer_type' => ['required', 'string'],
                'add_comp_name' => ['nullable', 'max:70'],
                'add_phone_num' => ['required', 'string', 'starts_with:0', 'size:11'],
                'add_date_founded' => ['nullable', 'max:30'],
                'add_barangay' => ['required', 'string', 'max:70'],
                'add_city' => ['required', 'string', 'max:70'],
                'add_work_location' => ['required', 'string', 'max:140'],
                'add_latitude' => ['required', 'numeric', 'between:-90, 90'],
                'add_longitude' => ['required', 'numeric', 'between:-180, 180'],
                'add_about' => ['required', 'string'],
                'add_business_permit' => [$request->hasFile('add_business_permit') ? 'required' : 'nullable', 'file', File::types(['pdf', 'docx'])->max(2 * 1024)],
                'add_valid_id_type' => ['required', 'string', 'max:100'],
                'add_valid_id' => [$request->hasFile('add_valid_id') ? 'required' : 'nullable', 'image', File::image()->max(2 * 1024)],
                'add_comp_size' => ['string', 'max:30'],
                'add_facebook_link' => ['required', 'string', 'max:255'],
            ]);

            $existingFile = Employer::where('account_id', $userID)->first();
            $selectedJobType = $request->add_job_type;

            if (empty($selectedJobType)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please select a job type.',
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
                $request->hasFile('add_valid_id') &&
                $existingFile &&
                $existingFile->valid_id &&
                Storage::disk('public')->exists($existingFile->valid_id)
            ) {
                Storage::disk('public')->delete($existingFile->valid_id);
            }

            if (
                $request->hasFile('add_business_permit') &&
                $existingFile &&
                $existingFile->business_permit &&
                Storage::disk('public')->exists($existingFile->business_permit)
            ) {
                Storage::disk('public')->delete($existingFile->business_permit);
            }

            $profilePath = null;
            $validIdPath = null;
            $permitPath = null;

            if ($request->hasFile('add_profile_pic')) {
                $profileFile = $request->file('add_profile_pic');
                $originalName = $profileFile->getClientOriginalName();
                $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $profileFile->getClientOriginalExtension();
                $profilePath = $profileFile->storeAs('profile', $filename, 'public');
            }

            if ($request->hasFile('add_valid_id')) {
                $idFile = $request->file('add_valid_id');
                $originalName = $idFile->getClientOriginalName();
                $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $idFile->getClientOriginalExtension();
                $validIdPath = $idFile->storeAs('valid-id', $filename, 'public');
            }

            if ($request->hasFile('add_business_permit')) {
                $permitFile = $request->file('add_business_permit');
                $originalName = $permitFile->getClientOriginalName();
                $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $permitFile->getClientOriginalExtension();
                $permitPath = $permitFile->storeAs('permit', $filename, 'public');
            }

            $data = [
                'first_name' => $request->add_first_name,
                'mid_name' => $request->add_mid_name,
                'last_name' => $request->add_last_name,
                'suffix' => $request->add_suffix,
                'employer_type' => $request->add_employer_type,
                'comp_name' => $request->add_comp_name,
                'phone_num' => $request->add_phone_num,
                'date_founded' => $request->add_date_founded,
                'barangay' => $request->add_barangay,
                'city' => $request->add_city,
                'work_location' => $request->add_work_location,
                'latitude' => $request->add_latitude,
                'longitude' => $request->add_longitude,
                'about' => $request->add_about,
                'valid_id_type' => $request->add_valid_id_type,
                'comp_size' => $request->add_comp_size,
                'facebook_link' => $request->add_facebook_link,
            ];

            if ($profilePath) $data['profile_pic'] = $profilePath;
            if ($validIdPath) $data['valid_id'] = $validIdPath;
            if ($permitPath) $data['business_permit'] = $permitPath;


            $data['account_id'] = $userID;
            $profile = Employer::updateOrCreate(['account_id' => $userID], $data);

            JobType::where('employer_id', $profile->employer_id)->delete();

            JobType::create([
                'seeker_id' => null,
                'employer_id' => $profile->employer_id,
                'job_type' => null,
                'job_type' => $selectedJobType,
            ]);

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
}

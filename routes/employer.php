<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignInController as SignIn;
use App\Http\Controllers\EmployerController as Employer;
use App\Http\Controllers\Employer\DashboardController as Dashboard;
use App\Http\Controllers\Employer\PostJobController as PostJob;
use App\Http\Controllers\Employer\PostedJobsController as PostedJobs;
use App\Http\Controllers\Employer\JobApplicationController as JobApplication;
use App\Http\Controllers\Employer\InteviewController as Interview;
use App\Http\Controllers\Employer\FollowingController as Following;
use App\Http\Controllers\Employer\NotificationController as Notification;
use App\Http\Controllers\Employer\ProfileController as Profile;
use App\Http\Controllers\Employer\SettingsController as Settings;
use App\Http\Controllers\Employer\FeedbackController as Feedback;

Route::get('/employer', [Employer::class, 'dashboard'])->name('emp.dashboard')->middleware('approved:employer');
Route::get('/employer/post-job', [Employer::class, 'post'])->name('emp.new.job')->middleware('approved:employer');
Route::get('/employer/posted-jobs', [Employer::class, 'posted'])->name('emp.posted.jobs')->middleware('approved:employer');
Route::get('/employer/application', [Employer::class, 'application'])->name('emp.application')->middleware('approved:employer');
Route::get('/employer/interview', [Employer::class, 'interview'])->name('emp.interview')->middleware('approved:employer');
Route::get('/employer/following', [Employer::class, 'following'])->name('emp.following')->middleware('approved:employer');
Route::get('/employer/notification', [Employer::class, 'notification'])->name('emp.notification')->middleware('approved:employer');
Route::get('/employer/profile', [Employer::class, 'profile'])->name('emp.profile')->withoutMiddleware('approved:employer');
Route::get('/employer/settings', [Employer::class, 'settings'])->name('emp.settings')->withoutMiddleware('approved:employer');

// -------------------------------------------------------------------------------------- LOGOUT SECTION

Route::post('/employer/logout', [SignIn::class, 'logout'])->name('emp.logout')->withoutMiddleware('approved:employer');

// -------------------------------------------------------------------------------------- DASHBOARD SECTION

//DASHBOARD
Route::get('/employer/summary', [Dashboard::class, 'summary'])->name('emp.dashboard.summary')->middleware('approved:employer');
Route::get('/employer/get-job-seekers', [Dashboard::class, 'getJobSeekers'])->name('emp.dashboard.seekers')->middleware('approved:employer');
Route::get('/employer/job-seeker/view/{seeker_id}', [Dashboard::class, 'viewJobSeeker'])->name('emp.view.seeker')->middleware('approved:employer');
Route::get('/employer/job-seeker/data', [Dashboard::class, 'getProfileData'])->name('emp.seeker.get.data')->middleware('approved:employer');
Route::post('/employer/job-seeker/follow', [Dashboard::class, 'followSeeker'])->name('emp.seeker.follow')->middleware('approved:employer');
Route::post('/check-follow-status', [Dashboard::class, 'isFollowing'])->name('emp.is.following')->middleware('approved:employer');
Route::post('/employer/job-seeker/report-job-seeker', [Dashboard::class, 'reportSeeker'])->name('emp.seeker.report')->withoutMiddleware('approved:job_seeker');


// -------------------------------------------------------------------------------------- POST JOB SECTION

//POST JOB
Route::get('/employer/post-job/get-data', [PostJob::class, 'getEmployerData'])->name('emp.post.job.get.data')->middleware('approved:employer');
Route::post('/employer/post-job/post-job', [PostJob::class, 'postJob'])->name('emp.post.job')->middleware('approved:employer');

// -------------------------------------------------------------------------------------- POSTED JOBS SECTION

//POSTED JOB
Route::get('/employer/posted-jobs/get-all', [PostedJobs::class, 'getPostedJobs'])->name('emp.posted.jobs.get')->middleware('approved:employer');
Route::get('/employer/posted-jobs/view/{job_id}', [PostedJobs::class, 'viewJob'])->name('emp.posted.jobs.view')->middleware('approved:employer');
Route::get('/employer/posted-jobs/data', [PostedJobs::class, 'getJobData'])->name('emp.posted.jobs.data')->middleware('approved:employer');
Route::get('/employer/posted-job/edit-job/{job_id}', [PostedJobs::class, 'viewEdit'])->name('emp.job.view.edit')->middleware('approved:employer');
Route::get('/employer/posted-jobs/edit-job/get', [PostedJobs::class, 'getEditData'])->name('emp.job.get.edit')->middleware('approved:employer');
Route::post('/employer/posted-jobs/edit-job/update', [PostedJobs::class, 'updateJobData'])->name('emp.job.update')->middleware('approved:employer');
Route::post('/employer/posted-jobs/view/delete', [PostedJobs::class, 'deleteJob'])->name('emp.job.delete')->middleware('approved:employer');
Route::get('/employer/posted-jobs/get-all-jobs', [PostedJobs::class, 'getJobsAndUpdateUnavailable'])->name('emp.job.get.all')->middleware('approved:employer');

// -------------------------------------------------------------------------------------- JOB APPLICATION SECTION

//JOB APPLICATION
Route::get('/employer/job-application/get-all', [JobApplication::class, 'getApplication'])->name('emp.application.get')->middleware('approved:employer');
Route::get('/employer/job-application/job-seeker/view/seeker_id={seeker_id}/job_id={job_id}', [JobApplication::class, 'viewJobSeeker'])->name('emp.application.view.seeker')->middleware('approved:employer');
Route::post('/employer/job-application/job-seeker/delete-applicant', [JobApplication::class, 'deleteApplicant'])->name('emp.application.delete')->middleware('approved:employer');
Route::get('/employer/job-application/job/view/{job_id}', [JobApplication::class, 'viewJob'])->name('emp.application.view.job')->middleware('approved:employer');
Route::get('/employer/job-application/view-applicant', [JobApplication::class, 'getApplicantData'])->name('emp.applicant.get.data')->middleware('approved:employer');
Route::get('/employer/job-application/view-applicant/check-status', [JobApplication::class, 'checkStatus'])->name('emp.applicant.check')->middleware('approved:employer');
Route::post('/employer/job-application/view-applicant/accept', [JobApplication::class, 'acceptApplicant'])->name('emp.applicant.accept')->middleware('approved:employer');
Route::post('/employer/job-application/view-applicant/reject', [JobApplication::class, 'rejectApplicant'])->name('emp.applicant.reject')->middleware('approved:employer');

// -------------------------------------------------------------------------------------- INTERVIEW SECTION

Route::get('/employer/job-interview/get-all', [Interview::class, 'getScheduled'])->name('emp.interview.get')->middleware('approved:employer');
Route::get('/employer/job-interview/get-details', [Interview::class, 'getInteviewDetails'])->name('emp.interview.details')->middleware('approved:employer');
Route::post('/employer/job-interview/update-details', [Interview::class, 'updateInterviewDetails'])->name('emp.interview.update')->middleware('approved:employer');
Route::post('/employer/job-interview/update-status', [Interview::class, 'changeApplicantStatus'])->name('emp.interview.update.status')->middleware('approved:employer');

// -------------------------------------------------------------------------------------- FOLLOWING JOB SEEKER SECTION

//FOLLOWING JOB SEEKER
Route::get('/employer/following/get-all', [Following::class, 'getFollowing'])->name('emp.following.get')->middleware('approved:employer');
Route::get('/employer/following/view/{seeker_id}', [Following::class, 'viewJobSeeker'])->name('emp.following.view.seeker')->middleware('approved:employer');
Route::post('/employer/following/unfollow', [Following::class, 'unfollow'])->name('emp.unfollow.seeker')->middleware('approved:employer');

// -------------------------------------------------------------------------------------- NOTIFICATION SECTION

//NOTIFICATION
Route::get('/employer/notification/get-all', [Notification::class, 'getNotification'])->name('emp.notification.get')->middleware('approved:employer');
Route::post('/employer/notification/delete', [Notification::class, 'deleteNotification'])->name('emp.notification.delete')->middleware('approved:employer');

// -------------------------------------------------------------------------------------- PROFILE SECTION

// PROFILE
Route::post('/employer/profile/edit-profile', [Profile::class, 'edit'])->name('emp.send.profile')->withoutMiddleware('approved:employer');
Route::get('/employer/profile/get-data', [Profile::class, 'getData'])->name('emp.get.profile')->withoutMiddleware('approved:employer');
Route::get('/employer/profile/get-edit-data', [Profile::class, 'getProfileData'])->name('emp.get.edit')->withoutMiddleware('approved:employer');

// -------------------------------------------------------------------------------------- SETTINGS SECTION

Route::post('/employer/settings/change-password', [Settings::class, 'changePassword'])->name('emp.edit.password')->withoutMiddleware('approved:job_seeker');
Route::post('/employer/settings/delete-account', [Settings::class, 'deleteAccount'])->name('emp.account.delete')->withoutMiddleware('approved:job_seeker');


// -------------------------------------------------------------------------------------- FEEDBACK SECTION

//FEEDBACK
Route::post('/employer/give-feedback', [Feedback::class, 'sendFeedback'])->name('emp.send.feedback')->middleware('approved:employer');
Route::get('/employer/get-email', [Feedback::class, 'getEmail'])->name('emp.get.email')->middleware('approved:employer');

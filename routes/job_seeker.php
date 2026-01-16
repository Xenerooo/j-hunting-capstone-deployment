<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignInController as SignIn;
use App\Http\Controllers\JobSeekerController as JobSeeker;
use App\Http\Controllers\JobSeeker\DashboardController as Dashboard;
use App\Http\Controllers\JobSeeker\AppliedJobsController as AppliedJobs;
use App\Http\Controllers\JobSeeker\JobInterviewController as Interview;
use App\Http\Controllers\JobSeeker\FollowingEmployerController as Following;
use App\Http\Controllers\JobSeeker\NotificationController as Notification;
use App\Http\Controllers\JobSeeker\ProfileController as Profile;
use App\Http\Controllers\JobSeeker\SettingsController as Settings;
use App\Http\Controllers\JobSeeker\FeedbackController as Feedback;

Route::get('/job-seeker', [JobSeeker::class, 'dashboard'])->name('js.dashboard')->middleware('approved:job_seeker');
Route::get('/job-seeker/applied', [JobSeeker::class, 'applied'])->name('js.applied')->middleware('approved:job_seeker');
Route::get('/job-seeker/interview', [JobSeeker::class, 'interview'])->name('js.interview')->middleware('approved:job_seeker');
Route::get('/job-seeker/notification', [JobSeeker::class, 'notification'])->name('js.notification')->middleware('approved:job_seeker');
Route::get('/job-seeker/following', [JobSeeker::class, 'following'])->name('js.following')->middleware('approved:job_seeker');
Route::get('/job-seeker/profile', [JobSeeker::class, 'profile'])->name('js.profile')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/settings', [JobSeeker::class, 'settings'])->name('js.settings')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/job', [JobSeeker::class, 'viewJob'])->name('js.job')->middleware('approved:job_seeker');
Route::get('/job-seeker/employer', [JobSeeker::class, 'viewEmployer'])->name('js.employer')->middleware('approved:job_seeker');

// -------------------------------------------------------------------------------------- LOGOUT SECTION

Route::post('/job-seeker/logout', [SignIn::class, 'logout'])->name('js.logout')->withoutMiddleware('approved:job_seeker');

// -------------------------------------------------------------------------------------- DASHBOARD SECTION

//DASHBOARD
Route::get('/job-seeker/dashboard/get-data', [Dashboard::class, 'getFeaturedData'])->name('js.featured.get')->withoutMiddleware('approved:job_seeker');

//EMPLOYERS
Route::get('/job-seeker/employer/view/{employer_id}', [Dashboard::class, 'viewEmployer'])->name('js.view.employer')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/employer/get-data', [Dashboard::class, 'getEmployerData'])->name('js.employer.get.data')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/employer/posted-jobs', [Dashboard::class, 'getPostedJobs'])->name('js.job.get.post')->withoutMiddleware('approved:job_seeker');
Route::get('/check-follow-status', [Dashboard::class, 'isFollowing'])->name('js.check.following')->middleware('approved:employer');
Route::post('/job-seeker/employer/follow', [Dashboard::class, 'followSeeker'])->name('js.employer.follow')->middleware('approved:employer');
Route::post('/job-seeker/employer/report-employer', [Dashboard::class, 'reportEmployer'])->name('js.employer.report')->withoutMiddleware('approved:job_seeker');

//JOBS
Route::get('/job-seeker/job/view/{job_id}', [Dashboard::class, 'viewJob'])->name('js.view.job')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/job/get-data', [Dashboard::class, 'getJobData'])->name('js.job.get.data')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/job/related-jobs', [Dashboard::class, 'getRelatedJobs'])->name('js.job.get.related')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/job/check-status', [Dashboard::class, 'checkApplicationStatus'])->name('js.job.check.status')->withoutMiddleware('approved:job_seeker');
Route::post('/job-seeker/job/apply-job', [Dashboard::class, 'applyJob'])->name('js.job.apply')->withoutMiddleware('approved:job_seeker');
Route::post('/job-seeker/job/report-job', [Dashboard::class, 'reportJob'])->name('js.job.report')->withoutMiddleware('approved:job_seeker');


// -------------------------------------------------------------------------------------- APPLIED JOBS SECTION

//APPLIED JOBS
Route::get('/job-seeker/applied-jobs/get-all', [AppliedJobs::class, 'getApplied'])->name('js.applied.get')->withoutMiddleware('approved:job_seeker');

// -------------------------------------------------------------------------------------- JOB INTERVIEW SECTION
//JOB INTERVIEW
Route::get('/job-seeker/job-interview/get-all', [Interview::class, 'getInterview'])->name('js.interview.get')->withoutMiddleware('approved:job_seeker');

// -------------------------------------------------------------------------------------- FOLLOWING EMPLOYERS SECTION

//FOLLOWING EMPLOYERS
Route::get('/job-seeker/following/get-all', [Following::class, 'getFollowing'])->name('js.following.get')->middleware('approved:job_seeker');
Route::get('/job-seeker/following/view/{employer_id}', [Following::class, 'viewEmployer'])->name('js.following.view.seeker')->middleware('approved:job_seeker');
Route::post('/job-seeker/following/unfollow', [Following::class, 'unfollow'])->name('js.unfollow.employer')->middleware('approved:job_seeker');
Route::post('/job-seeker/following/mute-notification', [Following::class, 'muteNotification'])->name('js.following.mute')->middleware('approved:job_seeker');

// -------------------------------------------------------------------------------------- NOTIFICAITONS SECTION

//NOTIFICATION
Route::get('/job-seeker/notification/get-all', [Notification::class, 'getNotification'])->name('js.notification.get')->middleware('approved:job_seeker');
Route::post('/job-seeker/notification/delete', [Notification::class, 'deleteNotification'])->name('js.notification.delete')->middleware('approved:job_seeker');



// -------------------------------------------------------------------------------------- PROFILE SECTION

//PROFILE
Route::post('/job-seeker/profile/edit-profile', [Profile::class, 'edit'])->name('js.send.profile')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/profile/get-data', [Profile::class, 'getData'])->name('js.get.profile')->withoutMiddleware('approved:job_seeker');
Route::get('/job-seeker/profile/get-edit-data', [Profile::class, 'getProfileData'])->name('js.get.edit')->withoutMiddleware('approved:job_seeker');
Route::post('/job-seeker/profile/upload-portfolio', [Profile::class, 'uploadPortfolio'])->name('js.upload.portfolio')->withoutMiddleware('approved:job_seeker');

// -------------------------------------------------------------------------------------- SETTINGS SECTION

//SETTINGS
Route::post('/job-seeker/settings/change-password', [Settings::class, 'changePassword'])->name('js.change.password')->withoutMiddleware('approved:job_seeker');
Route::post('/job-seeker/settings/delete-account', [Settings::class, 'deleteAccount'])->name('js.delete.account')->withoutMiddleware('approved:job_seeker');

// -------------------------------------------------------------------------------------- FEEDBACK SECTION

//FEEDBACK
Route::post('/job-seeker/give-feedback', [Feedback::class, 'sendFeedback'])->name('js.send.feedback')->middleware('approved:job_seeker');
Route::get('/job-seeker/get-email', [Feedback::class, 'getEmail'])->name('js.get.email')->middleware('approved:job_seeker');

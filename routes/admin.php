<?php

use Illuminate\Support\Facades\Route;

// ADMIN CONTROLLERS 
use App\Http\Controllers\Auth\SignInController as SignIn;
use App\Http\Controllers\AdminController as Admin;
use App\Http\Controllers\Admin\DashboardController as Dashboard;
use App\Http\Controllers\Admin\AllJobSeekerController as AllJobSeeker;
use App\Http\Controllers\Admin\AllEmployerController as AllEmployer;
use App\Http\Controllers\Admin\AllJobController as AllJob;
use App\Http\Controllers\Admin\RequestJobController as RequestJob;
use App\Http\Controllers\Admin\RequestJobSeekerController as RequestJobSeeker;
use App\Http\Controllers\Admin\RequestEmployerController as RequestEmployer;
use App\Http\Controllers\Admin\ReportedJobController as ReportedJob;
use App\Http\Controllers\Admin\ReportedSeekerController as ReportedSeeker;
use App\Http\Controllers\Admin\ReportedEmployerController as ReportedEmployer;
use App\Http\Controllers\Admin\FeedbackController as Feedback;
use App\Http\Controllers\Admin\SettingsController as Settings;

Route::get('/admin', [Admin::class, 'dashboard'])->name('admin.dashboard')->withoutMiddleware(['approved']);
Route::get('/admin/all-job-seekers', [Admin::class, 'jobSeekers'])->name('admin.seekers')->withoutMiddleware(['approved']);
Route::get('/admin/all-employers', [Admin::class, 'employers'])->name('admin.employers')->withoutMiddleware(['approved']);
Route::get('/admin/all-jobs', [Admin::class, 'jobs'])->name('admin.jobs')->withoutMiddleware(['approved']);
Route::get('/admin/request-jobs', [Admin::class, 'requestJob'])->name('admin.request.job')->withoutMiddleware(['approved']);
Route::get('/admin/request-job-seekers', [Admin::class, 'requestJobSeeker'])->name('admin.request.seeker')->withoutMiddleware(['approved']);
Route::get('/admin/request-employers', [Admin::class, 'requestEmployer'])->name('admin.request.employer')->withoutMiddleware(['approved']);
Route::get('/admin/reported-jobs', [Admin::class, 'reportedJobs'])->name('admin.reported.job')->withoutMiddleware(['approved']);
Route::get('/admin/reported-job-seekers', [Admin::class, 'repotedJobSeekers'])->name('admin.reported.seeker')->withoutMiddleware(['approved']);
Route::get('/admin/reported-employer', [Admin::class, 'reportedEmployers'])->name('admin.reported.employer')->withoutMiddleware(['approved']);
Route::get('/admin/feedback', [Admin::class, 'feedback'])->name('admin.feedback')->withoutMiddleware(['approved']);
Route::get('/admin/settings', [Admin::class, 'settings'])->name('admin.settings')->withoutMiddleware(['approved']);

// -------------------------------------------------------------------------------------- LOGOUT SECTION

Route::post('/admin/logout', [SignIn::class, 'logout'])->name('admin.logout')->withoutMiddleware('approved');

// -------------------------------------------------------------------------------------- DASHBOARD SECTION

//DASHBOARD
Route::get('/admin/data', [Dashboard::class, 'show'])->name('admin.dashboard.data')->withoutMiddleware(['approved']);
Route::get('/admin/registered', [Dashboard::class, 'monthlyRegistration'])->name('admin.dashboard.registered')->withoutMiddleware(['approved']);
Route::get('/admin/download-registration-excel', [Dashboard::class, 'downloadRegistrationExcel'])->name('admin.download.registration.excel')->withoutMiddleware(['approved']);

// -------------------------------------------------------------------------------------- ALL APPROVED SECTION

//ALL JOB SEEKER
Route::get('/admin/all-job-seekers/get-all-seekers', [AllJobSeeker::class, 'getAllJobSeeker'])->name('admin.all.seeker')->withoutMiddleware(['approved']);
Route::get('/admin/all-job-seekers/download', [AllJobSeeker::class, 'download'])->name('admin.all.seeker.download')->withoutMiddleware(['approved']);
Route::get('/admin/all-job-seekers/view/{seeker_id}', [AllJobSeeker::class, 'view'])->name('admin.view.seeker')->withoutMiddleware(['approved']);
Route::get('/admin/all-job-seekers/profile', [AllJobSeeker::class, 'getProfileData'])->name('admin.seeker.profile')->withoutMiddleware(['approved']);
Route::post('/admin/all-job-seekers/send-message', [AllJobSeeker::class, 'sendMessage'])->name('admin.seeker.send.message')->withoutMiddleware(['approved']);
Route::get('/admin/all-job-seekers/applied-jobs', [AllJobSeeker::class, 'appliedJobs'])->name('admin.seeker.applied.jobs')->withoutMiddleware(['approved']);

//ALL EMPLOYER
Route::get('/admin/all-employers/get-all-employers', [AllEmployer::class, 'getAllEmployer'])->name('admin.all.employer')->withoutMiddleware(['approved']);
Route::get('/admin/all-employers/download', [AllEmployer::class, 'download'])->name('admin.all.employer.download')->withoutMiddleware(['approved']);
Route::get('/admin/all-employers/view/{employer_id}', [AllEmployer::class, 'view'])->name('admin.view.employer')->withoutMiddleware(['approved']);
Route::get('/admin/all-employers/profile', [AllEmployer::class, 'getProfileData'])->name('admin.employer.profile')->withoutMiddleware(['approved']);
Route::post('/admin/all-employers/send-message', [AllEmployer::class, 'sendMessage'])->name('admin.employer.send.message')->withoutMiddleware(['approved']);
Route::get('/admin/all-employers/posted-jobs', [AllEmployer::class, 'postedJobs'])->name('admin.employer.posted.jobs')->withoutMiddleware(['approved']);

//ALL JOB
Route::get('/admin/all-jobs/get-all-jobs', [AllJob::class, 'getAllJob'])->name('admin.all.job')->withoutMiddleware(['approved']);
Route::get('/admin/all-jobs/download', [AllJob::class, 'download'])->name('admin.all.job.download')->withoutMiddleware(['approved']);
Route::get('/admin/all-jobs/view/{job_id}', [AllJob::class, 'view'])->name('admin.view.job')->withoutMiddleware(['approved']);
Route::get('/admin/all-jobs/details', [AllJob::class, 'getJobDetails'])->name('admin.job.get.details')->withoutMiddleware(['approved']);
Route::post('/admin/all-jobs/send-message', [AllJob::class, 'sendMessage'])->name('admin.job.send.message')->withoutMiddleware(['approved']);

// -------------------------------------------------------------------------------------- ALL REQUESTED SECTION

//REQUEST JOBS
Route::get('/admin/request-jobs/show-requests', [RequestJob::class, 'show'])->name('admin.job.request')->withoutMiddleware(['approved']);
Route::get('/admin/request-jobs/view/{job_id}', [RequestJob::class, 'view'])->name('admin.view.requested.job')->withoutMiddleware(['approved']);
Route::get('/admin/request-jobs/data', [RequestJob::class, 'getJobData'])->name('admin.job.get.data')->withoutMiddleware(['approved']);
Route::post('/admin/request-jobs/approval', [RequestJob::class, 'approval'])->name('admin.job.approval')->withoutMiddleware(['approved']);

//REQUEST JOB SEEKERS
Route::get('/admin/request-job-seekers/show-requests', [RequestJobSeeker::class, 'show'])->name('admin.seeker.request')->withoutMiddleware(['approved']);
Route::get('/admin/request-job-seekers/view/{seeker_id}', [RequestJobSeeker::class, 'view'])->name('admin.view.requested.seeker')->withoutMiddleware(['approved']);
Route::get('/admin/request-job-seekers/data', [RequestJobSeeker::class, 'getProfileData'])->name('admin.get.requested.seeker')->withoutMiddleware(['approved']);
Route::post('/admin/request-job-seekers/approval', [RequestJobSeeker::class, 'approval'])->name('admin.seeker.approval')->withoutMiddleware(['approved']);

//REQUEST EMPLOYERS
Route::get('/admin/request-employers/show-requests', [RequestEmployer::class, 'show'])->name('admin.employer.request')->withoutMiddleware(['approved']);
Route::get('/admin/request-employers/view/{employer_id}', [RequestEmployer::class, 'view'])->name('admin.view.requested.employer')->withoutMiddleware(['approved']);
Route::get('/admin/request-employers/data', [RequestEmployer::class, 'getProfileData'])->name('admin.employer.get.profile')->withoutMiddleware(['approved']);
Route::post('/admin/request-employers/approval', [RequestEmployer::class, 'approval'])->name('admin.employer.approval')->withoutMiddleware(['approved']);

// -------------------------------------------------------------------------------------- REPORTED SECTION

//REPORTED JOBS
Route::get('/admin/reported-jobs/show-reports', [ReportedJob::class, 'show'])->name('admin.job.reported')->withoutMiddleware(['approved']);
Route::get('/admin/reported-jobs/view/{job_id}', [ReportedJob::class, 'view'])->name('admin.view.reported.job')->withoutMiddleware(['approved']);
Route::post('/admin/reported-jobs/ignore-report', [ReportedJob::class, 'ignore'])->name('admin.job.reported.ignore')->withoutMiddleware(['approved']);

//REPORTED JOB SEEKERS
Route::get('/admin/reported-job-seekers/show-reports', [ReportedSeeker::class, 'show'])->name('admin.seeker.reported')->withoutMiddleware(['approved']);
Route::get('/admin/reported-job-seekers/view/{seeker_id}', [ReportedSeeker::class, 'view'])->name('admin.view.reported.seeker')->withoutMiddleware(['approved']);
Route::post('/admin/reported-job-seekers/ignore-reports', [ReportedSeeker::class, 'ignore'])->name('admin.seeker.reported.ignore')->withoutMiddleware(['approved']);

//REPORTED EMPLOYERS
Route::get('/admin/reported-employers/show-reports', [ReportedEmployer::class, 'show'])->name('admin.employer.reported')->withoutMiddleware(['approved']);
Route::get('/admin/reported-employers/view/{employer_id}', [ReportedEmployer::class, 'view'])->name('admin.view.reported.employer')->withoutMiddleware(['approved']);
Route::post('/admin/reported-employers/ignore-reports', [ReportedEmployer::class, 'ignore'])->name('admin.employer.reported.ignore')->withoutMiddleware(['approved']);

// -------------------------------------------------------------------------------------- FEEDBACK SECTION

//FEEDBACK
Route::get('/admin/feedback/get-all', [Feedback::class, 'getFeedback'])->name('admin.get.feedback')->withoutMiddleware(['approved']);
Route::get('/admin/feedback/get-details', [Feedback::class, 'getFeedbackDetails'])->name('admin.get.feedback.details')->withoutMiddleware(['approved']);
Route::get('/admin/feedback/display', [Feedback::class, 'displayFeedback'])->name('admin.display.feedback')->withoutMiddleware(['approved']);

// -------------------------------------------------------------------------------------- SETTINGS SECTION

//SETTINGS
Route::post('/admin/settings/change-password', [Settings::class, 'changePassword'])->name('admin.change.password')->withoutMiddleware(['approved']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignInController as SignIn;
use App\Http\Controllers\Auth\SignUpController as SignUp;
use App\Http\Controllers\LandingPageController as LandingPage;

// -------------------------------------------------------------------------------------- LANDING PAGE SECTION

Route::get('/', [LandingPage::class, 'index'])->name('index');
Route::get('/new-jobs', [LandingPage::class, 'newJobs'])->name('new.jobs');
Route::get('/new-employers', [LandingPage::class, 'newEmployers'])->name('new.employers');
Route::get('/about', [LandingPage::class, 'about'])->name('about');
Route::get('/feedback', [LandingPage::class, 'feedback'])->name('feedback');

// -------------------------------------------------------------------------------------- SIGN IN SECTION

Route::get('/login', function () {
  return redirect('/');
})->name('login');
Route::get('/sign-in', [SignIn::class, 'signIn'])->name('auth.sign.in');
Route::post('/sign-in', [SignIn::class, 'authenticate'])->name('sign.in.submit');

// forgot password
Route::get('/sign-in/forgot-password', [SignIn::class, 'forgotPassword'])->name('password.forgot');
Route::get('/sign-in/reset-password', [SignIn::class, 'passwordReset'])->name('password.reset');

Route::post('/forgot-password', [SignIn::class, 'forgotPasswordLink'])->name('password.email');
Route::post('/reset-password', [SignIn::class, 'resetPasswordLink'])->name('password.update');

// -------------------------------------------------------------------------------------- SIGN UP SECTION

Route::get('/sign-up', [SignUp::class, 'displaySignUp'])->name('auth.sign.up');
Route::get('/verify-email', [SignUp::class, 'verifyEmail'])->name('verify.email');
Route::get('/sign-up/email-sent', [SignUp::class, 'emailSent'])->name('email.sent');

// update user type
Route::post('/update-user-type', [SignUp::class, 'updateUserType'])->name('update.user.type');
Route::post('/sign-up', [SignUp::class, 'store'])->name('sign.up.submit');
Route::match(['post', 'get'], '/sign-up/send-verification-email', [SignUp::class, 'sendEmail'])->name('send.email');

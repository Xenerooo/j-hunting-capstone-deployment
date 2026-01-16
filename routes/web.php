<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  require_once "auth.php";
});

Route::middleware('auth')->group(function () {
  // job seeker navigation route
  require_once "job_seeker.php";

  // employer navigation route
  require_once "employer.php";

  // admin navigation route
  require_once "admin.php";
});

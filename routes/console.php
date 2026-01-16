<?php

use App\Console\Commands\MarkInactiveUsers;
use App\Models\Accounts;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::command(MarkInactiveUsers::class)->everyMinute();

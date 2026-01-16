<?php

namespace App\Console\Commands;

use App\Models\Accounts;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class MarkInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoff = Carbon::now()->subDays(30);
        $updated = Accounts::where('is_active', 1)
            ->where(function ($query) use ($cutoff) {
                $query->where('logged_in_at', '<', $cutoff)
                    ->orWhereNull('logged_in_at');
            })
            ->update(['is_active' => 0]);

        $this->info("[$updated] users marked as inactive.");
    }
}

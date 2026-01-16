<?php

namespace Database\Seeders;

use App\Models\Accounts;
use App\Models\Employer;
use App\Models\JobSeeker;
use Illuminate\Database\Seeder;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Accounts::where('user_type', '!=', 'admin')->get();

        foreach ($accounts as $account) {
            if ($account->user_type === 'job_seeker') {
                JobSeeker::factory()->create([
                    'account_id' => $account->account_id,
                ]);
            } elseif ($account->user_type === 'employer') {
                Employer::factory()->create([
                    'account_id' => $account->account_id,
                ]);
            }
        }
    }
}

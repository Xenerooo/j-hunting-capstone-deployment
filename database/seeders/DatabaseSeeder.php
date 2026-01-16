<?php

namespace Database\Seeders;

use App\Models\Accounts;
use App\Models\Employer;
use App\Models\JobSeeker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AccountsSeeder::class,
            ProfileSeeder::class,
        ]);
    }
}

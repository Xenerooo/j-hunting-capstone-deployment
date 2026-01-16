<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->insert([
            // admin account
            [
                'email' => 'admin@jhunting.com',
                'password' => Hash::make('admin123'),
                'user_type' => 'admin',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => true,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            // =======================
            // EMPLOYERS
            // =======================
            [
                // Full name: Maria Cruz
                'email' => 'maria.cruz@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Roberto Delos Santos
                'email' => 'roberto.delossantos@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Elena Torralba
                'email' => 'elena.torralba@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Carlos Mendoza
                'email' => 'carlos.mendoza@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Patricia Aguirre
                'email' => 'patricia.aguirre@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Diego Navarro
                'email' => 'diego.navarro@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Lorena Bustos
                'email' => 'lorena.bustos@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Hector Isidro
                'email' => 'hector.isidro@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Angeline Reyes
                'email' => 'angeline.reyes@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Francis Delgado
                'email' => 'francis.delgado@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Sofia Librado
                'email' => 'sofia.librado@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Ramon Valdez
                'email' => 'ramon.valdez@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Beatriz Castillo
                'email' => 'beatriz.castillo@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Julio Ponce
                'email' => 'julio.ponce@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Marisol Quinones
                'email' => 'marisol.quinones@gmail.com',
                'password' => Hash::make('employer@123'),
                'user_type' => 'employer',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],


            // =======================
            // JOB SEEKERS
            // =======================
            [
                // Full name: Kengie Caspe
                'email' => 'kengie.caspe@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Noimelyn Casimo
                'email' => 'noimelyn.casimo@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Khent Dela Cruz
                'email' => 'khent.delacruz@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Monica Paredes
                'email' => 'monica.paredes@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Jomar Reyes
                'email' => 'jomar.reyes@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Alyssa Torres
                'email' => 'alyssa.torres@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Michael Santos
                'email' => 'michael.santos@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Rhea Lopez
                'email' => 'rhea.lopez@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Enzo Manalo
                'email' => 'enzo.manalo@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Clarisse Garcia
                'email' => 'clarisse.garcia@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Mark Villanueva
                'email' => 'mark.villanueva@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Janine Rivera
                'email' => 'janine.rivera@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Paul Oliva
                'email' => 'paul.oliva@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Gina Sabado
                'email' => 'gina.sabado@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                // Full name: Luis Bernales
                'email' => 'luis.bernales@gmail.com',
                'password' => Hash::make('seeker@123'),
                'user_type' => 'job_seeker',
                'verify_token' => Str::random(65),
                'is_active' => true,
                'is_verified' => true,
                'is_approved' => false,
                'logged_in_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}

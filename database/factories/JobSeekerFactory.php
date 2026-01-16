<?php

namespace Database\Factories;

use App\Models\Accounts;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobSeeker>
 */
class JobSeekerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => null,
            'profile_pic' => null,
            'first_name' => $this->faker->firstName(),
            'mid_name' => $this->faker->optional()->firstName(),
            'last_name' => $this->faker->lastName(),
            'suffix' => $this->faker->optional()->randomElement(['Jr', 'Sr', 'III']),
            'job_type' => $this->faker->randomElement(['IT Specialist', 'Nurse', 'Teacher', 'Electrician', 'Driver']),
            'expertise' => $this->faker->word(),
            'phone_num' => '09' . $this->faker->numberBetween(100000000, 999999999),
            'birthday' => $this->faker->date('Y-m-d', '-20 years'),
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'experience' => $this->faker->optional()->randomElement(['1 year', '2 years', '3 years']),
            'age' => $this->faker->numberBetween(20, 40),
            'barangay' => $this->faker->streetName(),
            'city' => $this->faker->city(),
            'education' => $this->faker->randomElement(['High School', 'College Graduate', 'Vocational']),
            'resume' => 'uploads/resumes/' . Str::random(10) . '.pdf',
            'about' => $this->faker->optional()->paragraph(),
            'facebook_link' => 'https://facebook.com/' . Str::random(8),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

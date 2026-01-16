<?php

namespace Database\Factories;

use App\Models\Accounts;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $account = Accounts::where('user_type', '!=', 'admin')->inRandomOrder()->first();

        // if ($account->user_type == 'job_seeker') {
        //     return [
        //         'account_id' => $account->account_id,
        //         'profile_pic' => null,
        //         'first_name' => $this->faker->firstName(),
        //         'mid_name' => $this->faker->optional()->firstName(),
        //         'last_name' => $this->faker->lastName(),
        //         'suffix' => $this->faker->optional()->randomElement(['Jr', 'Sr', 'III']),
        //         'job_type' => $this->faker->randomElement(['IT Specialist', 'Nurse', 'Teacher', 'Electrician', 'Driver']),
        //         'expertise' => $this->faker->word(),
        //         'phone_num' => '09' . $this->faker->numberBetween(100000000, 999999999),
        //         'birthday' => $this->faker->date('Y-m-d', '-20 years'),
        //         'sex' => $this->faker->randomElement(['Male', 'Female']),
        //         'experience' => $this->faker->optional()->randomElement(['1 year', '2 years', '3 years']),
        //         'age' => $this->faker->numberBetween(20, 40),
        //         'barangay' => $this->faker->streetName(),
        //         'city' => $this->faker->city(),
        //         'education' => $this->faker->randomElement(['High School', 'College Graduate', 'Vocational']),
        //         'resume' => 'uploads/resumes/' . Str::random(10) . '.pdf',
        //         'about' => $this->faker->optional()->paragraph(),
        //         'facebook_link' => 'https://facebook.com/' . Str::random(8),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // if ($account->user_type === 'employer') {
        //     return [
        //         'account_id' => $account->account_id,
        //         'profile_pic' => null,
        //         'first_name' => $this->faker->firstName(),
        //         'mid_name' => $this->faker->optional()->firstName(),
        //         'last_name' => $this->faker->lastName(),
        //         'suffix' => $this->faker->optional()->randomElement(['Jr', 'Sr', 'III']),
        //         'employer_type' => $this->faker->randomElement(['Company', 'Individual']),
        //         'comp_name' => $this->faker->optional()->company(),
        //         'phone_num' => '09' . $this->faker->numberBetween(100000000, 999999999),
        //         'date_founded' => $this->faker->optional()->date('Y-m-d', '-10 years'),
        //         'barangay' => $this->faker->streetName(),
        //         'city' => $this->faker->city(),
        //         'work_location' => $this->faker->address(),
        //         'latitude' => $this->faker->latitude(11.5, 12.5),
        //         'longitude' => $this->faker->longitude(125.0, 126.0),
        //         'job_type' => $this->faker->randomElement(['Healthcare', 'Construction', 'IT', 'Education', 'Retail']),
        //         'about' => $this->faker->optional()->paragraph(),
        //         'business_permit' => 'uploads/business_permits/' . Str::random(10) . '.pdf',
        //         'valid_id_type' => $this->faker->randomElement(['Driver’s License', 'Passport', 'National ID']),
        //         'valid_id' => 'uploads/ids/' . Str::random(10) . '.jpg',
        //         'comp_size' => $this->faker->optional()->randomElement(['1-10', '11-50', '51-100', '100+']),
        //         'facebook_link' => 'https://facebook.com/' . Str::random(8),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        return [];
    }
}

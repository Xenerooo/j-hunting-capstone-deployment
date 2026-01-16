<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Accounts;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FeedbackSeeder extends Seeder
{
  public function run(): void
  {
    // Get some existing accounts to associate feedback with
    $accounts = Accounts::where('is_approved', 1)->take(5)->get();

    if ($accounts->count() > 0) {
      $sampleFeedbacks = [
        [
          'content' => 'J-Hunting helped me find my dream job! The platform is intuitive and the job matching is spot-on. Found my perfect position in just 2 weeks!',
          'rating' => 5,
          'is_displayed' => true,
        ],
        [
          'content' => 'As an employer, I found excellent candidates through J-Hunting. The platform is user-friendly and the quality of applicants is outstanding.',
          'rating' => 5,
          'is_displayed' => true,
        ],
        [
          'content' => 'Great platform for job seekers! The application process is smooth and I received quick responses from employers.',
          'rating' => 4,
          'is_displayed' => true,
        ],
        [
          'content' => 'J-Hunting has revolutionized our hiring process. We\'ve found talented professionals who perfectly match our company culture.',
          'rating' => 5,
          'is_displayed' => true,
        ],
        [
          'content' => 'The job recommendations are accurate and relevant to my skills. I appreciate the personalized approach of this platform.',
          'rating' => 4,
          'is_displayed' => true,
        ],
      ];

      foreach ($sampleFeedbacks as $index => $feedbackData) {
        if (isset($accounts[$index])) {
          Feedback::create([
            'account_id' => $accounts[$index]->account_id,
            'content' => $feedbackData['content'],
            'rating' => $feedbackData['rating'],
            'is_displayed' => $feedbackData['is_displayed'],
            'feedback_at' => Carbon::now()->subDays(rand(1, 30)),
          ]);
        }
      }
    }
  }
}

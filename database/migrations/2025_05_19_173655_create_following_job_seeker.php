<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('following_job_seeker', function (Blueprint $table) {
            $table->id('emp_follow_id');
            $table->foreignId('seeker_id')->constrained('job_seeker', 'seeker_id')->onDelete('cascade');
            $table->foreignId('employer_id')->constrained('employer', 'employer_id')->onDelete('cascade');
            $table->timestamp('followed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('following_job_seeker');
    }
};

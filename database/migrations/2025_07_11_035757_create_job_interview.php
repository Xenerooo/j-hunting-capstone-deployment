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
        Schema::create('job_interview', function (Blueprint $table) {
            $table->id('interview_id');
            $table->foreignId('employer_id')->constrained('employer', 'employer_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('seeker_id')->constrained('job_seeker', 'seeker_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('job_id')->constrained('jobs', 'job_id')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['pending', 'completed', 'missed'])->default('pending');
            $table->date('date');
            $table->enum('mode', ['in-person', 'online']);
            $table->string('detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_interview');
    }
};

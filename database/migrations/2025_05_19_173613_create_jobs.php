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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('job_id');
            $table->foreignId('employer_id')->constrained('employer', 'employer_id')->onDelete('cascade');
            $table->string('title', 70);
            $table->text('description');
            $table->string('employment_type', 30);
            $table->string('experience_level', 20);
            $table->decimal('expected_salary', 8, 2);
            $table->string('salary_basis', 25);
            $table->string('education_level', 100);
            $table->string('job_photo', 255)->nullable();
            $table->string('location', 140);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->integer('max_applicant');
            $table->integer('hired_applicant')->default(0);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_reported')->default(false);
            $table->enum('status', ['pending', 'accepted', 'rejected', 'restricted', 'expired'])->default('pending');
            $table->dateTime('deadline_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};

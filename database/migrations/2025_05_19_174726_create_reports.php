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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('report_id');
            $table->foreignId('employer_id')->nullable()->constrained('employer', 'employer_id')->onDelete('cascade');
            $table->foreignId('seeker_id')->nullable()->constrained('job_seeker', 'seeker_id')->onDelete('cascade');
            $table->foreignId('job_id')->nullable()->constrained('jobs', 'job_id')->onDelete('cascade');
            $table->string('report_title', 50);
            $table->text('report_content');
            $table->timestamp('reported_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

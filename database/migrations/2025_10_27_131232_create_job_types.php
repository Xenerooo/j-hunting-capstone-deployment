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
        Schema::create('job_types', function (Blueprint $table) {
            $table->id('jtype_id');
            $table->foreignId('seeker_id')->nullable()->constrained('job_seeker', 'seeker_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('employer_id')->nullable()->constrained('employer', 'employer_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_id')->nullable()->constrained('jobs', 'job_id')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('job_type', [
                "Administrative & Office Work",
                "Agriculture & Fisheries",
                "Business Process Outsourcing",
                "Construction & Skilled Work",
                "Criminal Justice & Law Enforcement",
                "Culinary",
                "Education & Training",
                "Engineering",
                "Freelance & Creative Work",
                "Government Service",
                "Healthcare & Medical",
                "Hospitality & Tourism",
                "Information Technology (IT)",
                "Manufacturing",
                "Retail & Sales",
                "Transportation & Logistics"
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_types');
    }
};

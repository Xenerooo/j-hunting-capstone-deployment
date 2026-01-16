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
        Schema::create('job_seeker', function (Blueprint $table) {
            $table->id('seeker_id');
            $table->foreignId('account_id')->constrained('accounts', 'account_id')->onDelete('cascade');
            $table->string('profile_pic', 255)->nullable();
            $table->string('first_name', 50);
            $table->string('mid_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('suffix', 3)->nullable();
            $table->string('expertise', 100);
            $table->string('phone_num', 11);
            $table->date('birthday');
            $table->string('sex', 10);
            $table->string('experience', 10)->nullable();
            $table->integer('age');
            $table->string('barangay', 70);
            $table->string('city', 70);
            $table->string('education', 100);
            $table->string('resume', 255);
            $table->text('about')->nullable();
            $table->string('facebook_link', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_seeker');
    }
};

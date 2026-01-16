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
        Schema::create('employer', function (Blueprint $table) {
            $table->id('employer_id');
            $table->foreignId('account_id')->constrained('accounts', 'account_id')->onDelete('cascade');
            $table->string('profile_pic', 255)->nullable();
            $table->string('first_name', 50);
            $table->string('mid_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('suffix', 3)->nullable();
            $table->enum('employer_type', ['Company', 'Individual']);
            $table->string('comp_name', 70)->nullable();
            $table->string('phone_num', 11);
            $table->string('date_founded', 30)->nullable();
            $table->string('barangay', 70);
            $table->string('city', 70);
            $table->string('work_location', 140);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->text('about')->nullable();
            $table->string('business_permit', 255);
            $table->string('valid_id_type', 255);
            $table->string('valid_id', 255);
            $table->string('comp_size', 30)->nullable();
            $table->string('facebook_link', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer');
    }
};

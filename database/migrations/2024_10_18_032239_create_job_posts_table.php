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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->constrained('recruiters')->onDelete('cascade');
            $table->string('title');
            $table->string('salary');
            $table->string('vacancy');
            $table->date('deadline');
            $table->string('location');
            $table->string('work_status');
            $table->text('details')->comment('responsibilities and job details');
            $table->text('other_benefits')->nullable();
            $table->json('requirements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};

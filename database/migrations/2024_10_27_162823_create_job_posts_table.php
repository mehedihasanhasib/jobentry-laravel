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
            $table->uuid('uuid');
            $table->foreignId('recruiter_id')->constrained();
            $table->string('title');
            $table->string('salary');
            $table->integer('vacancy');
            $table->integer('experience');
            $table->date('deadline');
            $table->foreignId('location_id')->constrained();
            $table->string('work_status');
            $table->foreignId('categories_id')->constrained();
            $table->json('working_days');
            $table->time('working_hours');
            $table->json('requirements');
            $table->text('details');
            $table->text('other_benefits');
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

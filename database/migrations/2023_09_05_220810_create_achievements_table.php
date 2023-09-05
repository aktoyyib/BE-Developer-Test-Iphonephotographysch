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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Achievement name, e.g., "First Lesson Watched"
            $table->enum('type', ['lesson', 'comment']); // Type of achievement: "lesson" or "comment"
            $table->integer('threshold'); // Number of lessons or comments needed to unlock
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};

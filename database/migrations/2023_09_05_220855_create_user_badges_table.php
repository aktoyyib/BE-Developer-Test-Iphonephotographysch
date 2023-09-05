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
        Schema::create('user_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')  
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('badge_id')  
                    ->constrained('badges')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('badge_name'); //Not necessary but added it bcos question requested it as a payload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_badges');
    }
};

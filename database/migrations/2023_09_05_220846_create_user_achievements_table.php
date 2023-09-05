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
        Schema::create('user_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')  
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('achievement_id')  
                    ->constrained('achievements')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('achievement_name'); //Not necessary bcos it can be gotten from achievement_id but added it bcos question requested it as a payload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_achievements');
    }
};

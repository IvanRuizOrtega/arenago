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
        Schema::create('match_player_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('team_id');
            $table->unsignedTinyInteger('goals')->default(0);
            $table->unsignedTinyInteger('assists')->default(0);
            $table->timestamps();
            $table->unique(['booking_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_player_stats');
    }
};

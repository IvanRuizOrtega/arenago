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
        Schema::create('playing_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_center_id')->index();
            $table->string('name')->nullable();
            $table->string('type', 10)->index();
            $table->decimal('price_hour', 12, 2);
            $table->boolean('covered')->default(FALSE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playing_fields');
    }
};

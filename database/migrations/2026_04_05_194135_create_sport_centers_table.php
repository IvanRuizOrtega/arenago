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
        Schema::create('sport_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->decimal('lat', 10, 8);
            $table->decimal('long', 11, 8);
            $table->text('working_days')->nullable();
            $table->boolean('is_public')->default(FALSE);
            $table->index(['lat', 'long']);
            $table->index('lat');
            $table->index('long');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_centers');
    }
};

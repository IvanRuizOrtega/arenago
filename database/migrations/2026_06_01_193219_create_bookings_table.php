<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Src\Resources\Constants\Options;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('playing_field_id')->constrained()->cascadeOnDelete();
            $table->date('date')->index();
            $table->time('start_time')->index();
            $table->time('end_time')->index();
            $table->enum('status', array_keys(Options::STATUS))->default('pending');
            $table->decimal('total_price', 12, 2);
            $table->foreignId('attended_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('message')->nullable();
            $table->enum('ranking', [1, 2, 3, 4, 5])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

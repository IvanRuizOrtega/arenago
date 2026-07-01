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
        Schema::create('pqrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('ranking', [1, 2, 3, 4, 5])->nullable();
            $table->text('improvement_idea')->nullable();
            $table->enum('type', ['petition', 'complaint', 'claim', 'suggestion', 'improvement_idea', 'ranking']);
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqrs');
    }
};

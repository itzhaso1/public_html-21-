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
        Schema::create('about_counter_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->unique(['about_counter_id', 'locale']);
            $table->index(['about_counter_id', 'locale']);
            $table->foreignId('about_counter_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_counter_translations');
    }
};

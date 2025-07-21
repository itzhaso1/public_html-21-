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
        Schema::create('type_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name')->nullable();
            $table->unique(['type_id', 'locale']);
            $table->index(['type_id', 'locale']);
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_translations');
    }
};

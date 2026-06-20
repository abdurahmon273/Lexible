<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained()->cascadeOnDelete();
            $table->string('word');
            $table->string('phonetic')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('status', 32)->default('active')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['language_id', 'word']);
            $table->index('word');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};

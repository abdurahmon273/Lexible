<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('word_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_sense_id')->constrained()->cascadeOnDelete();
            $table->foreignId('target_language_id')->constrained('languages')->cascadeOnDelete();
            $table->string('translation');
            $table->text('example')->nullable();
            $table->text('meaning_note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['target_language_id', 'translation']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('word_translations');
    }
};

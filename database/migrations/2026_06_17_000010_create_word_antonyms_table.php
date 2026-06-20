<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('word_antonyms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_sense_id')->constrained()->cascadeOnDelete();
            $table->string('antonym');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['word_sense_id', 'antonym']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('word_antonyms');
    }
};

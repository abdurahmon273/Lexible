<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('word_definitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_sense_id')->constrained()->cascadeOnDelete();
            $table->text('definition');
            $table->text('example')->nullable();
            $table->string('source')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('word_definitions');
    }
};

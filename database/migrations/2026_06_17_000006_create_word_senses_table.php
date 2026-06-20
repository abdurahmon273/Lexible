<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('word_senses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_id')->constrained()->cascadeOnDelete();
            $table->string('part_of_speech', 64)->nullable();
            $table->string('level', 32)->nullable();
            $table->unsignedInteger('order_number');
            $table->text('meaning_note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['word_id', 'order_number']);
            $table->index(['part_of_speech', 'level']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('word_senses');
    }
};

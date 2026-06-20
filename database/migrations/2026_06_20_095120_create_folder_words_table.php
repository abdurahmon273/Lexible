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
        Schema::create('folder_words', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('word_id');
            $table->unsignedBigInteger('word_sense_id');
            $table->unsignedBigInteger('folder_id');
            $table->integer('degree')->default(0);

            $table->foreign('folder_id')->references('id')->on('folders');
            $table->foreign('word_id')->references('id')->on('words');
            $table->foreign('word_sense_id')->references('id')->on('word_senses');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folder_words');
    }
};

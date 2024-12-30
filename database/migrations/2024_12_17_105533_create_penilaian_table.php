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
        Schema::create('tb_penilaian', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->integer('soal1_A');
            $table->integer('soal2_A');
            $table->integer('soal3_A');
            $table->integer('soal4_A');
            $table->integer('soal5_A');
            $table->integer('soal6_A');
            $table->integer('soal7_A');
            $table->integer('soal8_A');
            $table->integer('soal1_B');
            $table->integer('soal2_B');
            $table->integer('soal3_B');
            $table->integer('soal4_B');
            $table->integer('soal5_B');
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_penilaian');
    }
};

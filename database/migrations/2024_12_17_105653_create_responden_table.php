<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_responden', function (Blueprint $table) {
            $table->id('id_responden');
            $table->string('gender');
            $table->unsignedBigInteger('age');
            $table->string('education');
            $table->string('employment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_responden');
    }
};

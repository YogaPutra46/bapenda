<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_quisioner', function (Blueprint $table) {
            $table->id('id_quisioner');
            $table->foreignId('id_responden')
                ->constrained('tb_responden', 'id_responden')
                ->onDelete('cascade');
            $table->foreignId('id_pelayanan')
                ->constrained('tb_pelayanan', 'id_pelayanan')
                ->onDelete('cascade');
            $table->foreignId('id_penilaian')
                ->constrained('tb_penilaian', 'id_penilaian')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_quisioner');
    }
};

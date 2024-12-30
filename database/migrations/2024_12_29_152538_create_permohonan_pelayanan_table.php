<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanPelayananTable extends Migration
{
    public function up()
    {
        Schema::create('permohonan_pelayanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('npwpd');
            $table->string('nopd');
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_penerbitan');
            $table->enum('status', ['belum_divalidasi', 'divalidasi'])->default('belum_divalidasi'); // Status field
            $table->string('file_surat_permohonan')->nullable();
            $table->string('file_sktpd')->nullable();
            $table->string('file_sspd')->nullable();
            $table->string('file_laporan_keuangan')->nullable();
            $table->string('file_bukti_pendukung')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id_user')->on('tb_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permohonan_pelayanan');
    }
}

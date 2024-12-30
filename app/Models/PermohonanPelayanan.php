<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanPelayanan extends Model
{
    use HasFactory;

    protected $table = 'permohonan_pelayanan';

    protected $fillable = [
        'nama_pemohon',
        'npwpd',
        'nopd',
        'tanggal_pengajuan',
        'tanggal_penerbitan',
        'status',
        'file_surat_permohonan',
        'file_sktpd',
        'file_sspd',
        'file_laporan_keuangan',
        'file_bukti_pendukung',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tanggal_penerbitan' => 'date',
    ];
}

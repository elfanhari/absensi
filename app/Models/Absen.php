<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function hitungJumlahAbsen($tingkat, $tanggalAwal, $tanggalAkhir, $keterangan)
    // {
    //     return $this->where('siswa_id', $tingkat)
    //         ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
    //         ->where('keterangan', $keterangan)
    //         ->whereNotIn('tanggal', function ($query) {
    //           $query->select('tgl')->from('hari_liburs');
    //         })
    //         ->count();
    // }

    public function hitungJumlahAbsenPerTingkat($tingkat, $tanggalAwal, $tanggalAkhir, $keterangan)
    {
        return DB::table('absens')
            ->join('siswas', 'absens.siswa_id', '=', 'siswas.id')
            ->join('kelas', 'siswas.kelas_id', '=', 'kelas.id')
            ->where('kelas.tingkat', $tingkat)
            ->whereBetween('absens.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('absens.keterangan', $keterangan)
            ->whereNotIn('absens.tanggal', function ($query) {
                $query->select('tgl')->from('hari_liburs');
            })
            ->count();
    }


    public function pertemuan()
    {
      return $this->belongsTo(Pertemuan::class);
    }

    public function siswa()
    {
      return $this->belongsTo(Siswa::class);
    }

}

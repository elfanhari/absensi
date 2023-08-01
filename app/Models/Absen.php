<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

    public static function getSiswaByKelasAndKeterangan($kelasId, $keterangan, $tanggal)
    {
      return self::whereHas('siswa', function ($query) use ($kelasId) {
          $query->where('kelas_id', $kelasId);
        })->where('keterangan', $keterangan)
          ->whereDate('tanggal', $tanggal)
          ->join('siswas', 'absens.siswa_id', '=', 'siswas.id')
          ->orderBy('siswas.name', 'ASC')
          ->get();
    }

    public static function countKetidakhadiran($tanggal, $keterangan)
    {
      return self::where('tanggal', $tanggal)
                ->where('keterangan', $keterangan)
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

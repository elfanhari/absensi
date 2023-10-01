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

    public static function getSiswaByKelasAndTanggalAndKeterangan($kelasId, $tanggal, $keterangan)
    {
        return self::whereHas('siswa', function ($query) use ($kelasId) {
            $query->where('kelas_id', $kelasId);
        })->where('keterangan', '!=', $keterangan)
          ->whereDate('tanggal', $tanggal)
          ->orderBy('siswa_id', 'ASC')
          ->get();
    }

    public static function getAbsenHariIni($kelas_id, $tanggal)
    {
      $siswa_id = Siswa::where('kelas_id', $kelas_id)->get()->pluck('id');
      return self::whereIn('siswa_id', $siswa_id)->where('tanggal', $tanggal)->distinct('tanggal')->pluck('tanggal');
    }

    public function pertemuan()
    {
      return $this->belongsTo(Pertemuan::class);
    }

    public function siswa()
    {
      return $this->belongsTo(Siswa::class);
    }

    public static function absenDiTglTsb($siswa_id, $tanggal)
    {
      return self::where('siswa_id', $siswa_id)->where('tanggal', $tanggal)->first();
    }

    public static function countAbsenPerSiswa($keterangan, $siswa_id, $months, $libur)
    {
      $absen = self::where('siswa_id', $siswa_id)
                  ->whereIn('keterangan', [$keterangan])
                  ->where('tanggal', '>=', $months[0])
                  ->where('tanggal', '<=', end($months))
                  ->whereNotIn('tanggal', $libur->pluck('tgl'))
                  ->count();
      return ($absen > 0) ? $absen : '';

    }
}

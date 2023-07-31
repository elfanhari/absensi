<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Kelas;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use PDF;

class RekapAbsensiPerTingkatController extends Controller
{

  public function perangkatan(Request $req) {

      $req->validate([
        'tglawal' => 'required',
        'tglakhir' => 'required',
      ]);

      $tglAkhir = $req->tglakhir;
      $tglAwal = $req->tglawal;

      $strTglAwal = date('d-m-Y', strtotime($tglAwal));
      $strTglAkhir = date('d-m-Y', strtotime($tglAkhir));

      $tingkat = [
        [
          'int' => 7,
          'str' => 'Tujuh'
        ],
        [
          'int' => 8,
          'str' => 'Delapan'
        ],
        [
          'int' => 9,
          'str' => 'Sembilan'
        ],
      ];

      if ($strTglAwal == $strTglAkhir) {
        $periode = $strTglAwal;
      } else {
        $periode = $strTglAwal . ' s/d ' . $strTglAkhir;
      }

      $pdf = PDF::loadview('pages.rekapabsensi.perangkatan.print',[
        'periode' => $periode,
        'sekolah' => Sekolah::first(),
        'tglAwal' => $tglAwal,
        'tglAkhir' => $tglAkhir,
        'tingkat' => $tingkat,
      ])->setPaper('F4', 'Potrait');
      return $pdf->stream('REKAPITULASI ABSENSI - ' . $strTglAwal . ' s/d ' . $strTglAkhir .  '.pdf');
  }

}

<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\HariLibur;
use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Sekolah;
use App\Models\Siswa;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(auth()->user()->role === 'siswa'){
        abort('403');
      } else{
        $role = auth()->user()->role;
        if(auth()->user()->role === 'admin' || auth()->user()->role === 'piket'){
          $kelas = Kelas::get();
        } elseif(auth()->user()->role === 'guru'){
          $kelas = Kelas::where('guru_id', Auth::user()->guru->id)->get();
        } elseif(auth()->user()->role === 'siswa'){
          $kelas = Kelas::where('id', Auth::user()->siswa->kelas_id)->get();
        }
        return view('pages.rekapabsensi.index', compact('role', 'kelas'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function per1bulan(Request $request, $role, $id) {

      $year = $request->year;
      $month = $request->bulan;

      $startDate = Carbon::create($year, $month, 1);
      $endDate = $startDate->copy()->endOfMonth();
      $datesInMonth = [];
      while ($startDate->lte($endDate)) {
        $datesInMonth[] = $startDate->toDateString();
        $startDate->addDay();
      }

      $kelas = Kelas::whereId($id)->first();

      $pdf = PDF::loadview('pages.rekapabsensi.per1bulan.print',[
        'kelas' => $kelas,
        'monthIndo' => Carbon::create()->month($month)->locale('id')->isoFormat('MMMM') . ' ' . $year,
        'month' => $month,
        'months' => $datesInMonth,
        'siswa' => Siswa::where('kelas_id', $kelas->id)->orderBy('name', 'ASC')->get(),
        'role' => Auth::user()->role,
        'libur' => HariLibur::get(),
        'absen' => Absen::get(),
        'sekolah' => Sekolah::first()
      ])->setPaper('F4', 'Potrait');
      return $pdf->stream('REKAPITULASI ABSENSI -  ' . $kelas->name .  ' -' . Carbon::create()->month($month)->locale('id')->isoFormat('MMMM') . ' ' . $year . '.pdf');
    }

    function per3bulan(Request $request, $role, $id) {
      $bulanA = intval(Str::before($request->bulan, '-'));
      $strBulanA = Carbon::create()->month($bulanA)->locale('id')->isoFormat('MMMM');

      $bulanB = intval(Str::before($request->bulan, '-')) + 1;
      $strBulanB = Carbon::create()->month($bulanB)->locale('id')->isoFormat('MMMM');

      $bulanC = intval(Str::after($request->bulan, '-'));
      $strBulanC = Carbon::create()->month($bulanC)->locale('id')->isoFormat('MMMM');

      $tglAwal = date('Y-m-01', strtotime( $request->year . '-' . $bulanA));
      $tglAkhir = date('Y-m-d', strtotime('-1 day', strtotime('+3 month', strtotime($tglAwal))));

      $kelas = Kelas::whereId($id)->first();
      $pdf = PDF::loadview('pages.rekapabsensi.per3bulan.print',[
        'kelas' => $kelas,
        'siswa' => Siswa::where('kelas_id', $kelas->id)->get(),
        'periode' => $strBulanA . ', ' . $strBulanB . ', dan ' . $strBulanC . ' ' . $request->year,
        'sekolah' => Sekolah::first(),
        'tglAwal' => $tglAwal,
        'tglAkhir' => $tglAkhir,
      ])->setPaper('F4', 'Potrait');
      return $pdf->stream('REKAPITULASI ABSENSI - ' . $kelas->name . ' - PER 3 BULAN' .  '.pdf');
    }

    function persemester(Request $request, $role, $id) {
      $bulanA = intval(Str::before($request->bulan, '-'));
      $tglAwal = date('Y-m-01', strtotime( $request->year . '-' . $bulanA));
      $tglAkhir = date('Y-m-d', strtotime('-1 day', strtotime('+6 month', strtotime($tglAwal))));
      $kelas = Kelas::whereId($id)->first();
      $pdf = PDF::loadview('pages.rekapabsensi.persemester.print',[
        'kelas' => $kelas,
        'siswa' => Siswa::where('kelas_id', $kelas->id)->get(),
        'periode' => 'Satu Semester',
        'sekolah' => Sekolah::first(),
        'tglAwal' => $tglAwal,
        'tglAkhir' => $tglAkhir,
      ])->setPaper('F4', 'Potrait');
      return $pdf->stream('REKAPITULASI ABSENSI -  ' . $kelas->name . ' - PER SEMESTER' . '.pdf');
    }

    function pertahun(Request $request, $role, $id) {

      $tglAwal = intval($request->year) -1 . '-07-01';
      $tglAkhir = $request->year . '-06-30';

      $kelas = Kelas::whereId($id)->first();
      $pdf = PDF::loadview('pages.rekapabsensi.pertahun.print',[
        'kelas' => $kelas,
        'siswa' => Siswa::where('kelas_id', $kelas->id)->get(),
        'periode' => 'Satu Tahun Pelajaran',
        'sekolah' => Sekolah::first(),
        'tglAwal' => $tglAwal,
        'tglAkhir' => $tglAkhir,
      ])->setPaper('F4', 'Potrait');
      return $pdf->stream('REKAPITULASI ABSENSI - ' . $kelas->name .  ' - PER TAHUN' . '.pdf');
    }


}

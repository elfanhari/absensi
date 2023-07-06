<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Sekolah;
use App\Models\Siswa;
use PDF;
use Illuminate\Http\Request;

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

        if(auth()->user()->role === 'admin'){
          $pembelajaran = Pembelajaran::orderBy('mapel_id', 'ASC')->get();
        } else{
          $pembelajaran = Pembelajaran::where('guru_id', auth()->user()->guru->id)->orderBy('mapel_id', 'ASC')->get();
        }

        $role = auth()->user()->role;
        $pertemuan = Pertemuan::get();
        return view('pages.rekapabsensi.index', compact('pembelajaran', 'role', 'pertemuan'));
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

    function printRekapitulasi($role, $id) {
      $pembelajaran = Pembelajaran::whereId($id)->first();
      $pdf = PDF::loadview('pages.rekapabsensi.print', [
        'pembelajaran' => $pembelajaran,
        'sekolah' => Sekolah::first(),
        'siswa' => Siswa::where('kelas_id', $pembelajaran->kelas_id)->get(),
        'pertemuan' => Pertemuan::where('pembelajaran_id', $id)->orderBy('pertemuan_ke', 'ASC')->get(),
        'absen' => Absen::get(),
        'role' => auth()->user()->role,
      ])->setPaper('Folio', 'Landscape');
      return $pdf->stream('REKAP ABSENSI.pdf');
    }
}

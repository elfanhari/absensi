<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tapel;
use Illuminate\Http\Request;

class DataTapelController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if(auth()->user()->role !== 'admin'){
      abort('403');
    } else{
        $tapel = Tapel::orderBy('tahun_pelajaran', 'ASC')->get();
        $kelas = Kelas::get();
        $mapel = Mapel::get();
        return view('pages.datatapel.index', compact('tapel', 'mapel', 'kelas'));
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
    if (!$request->filled([
      'tahun_pelajaran',
      'semester',
      ])) {
        return back()->withFailed('Formulir tidak boleh kosong!');
    }

    $request->validate([
      'tahun_pelajaran' => 'required',
      'semester' => 'required',
    ]);

    $tahun_pelajaran = Tapel::where('tahun_pelajaran', $request->tahun_pelajaran)->get()->pluck('semester');
    $semesterUdahAda = $request->semester;

    if ($tahun_pelajaran->contains($semesterUdahAda)) {
      return back()->withFailed('Data yang ingin Anda tambahkan sudah ada!');
    } else {
      $tapel = Tapel::create($request->all());
      $tapel;
      return redirect(route('datatapel.index'))->withSuccess('Data Tapel: <b>' . $tapel->tahun_pelajaran . ' Semester ' . $tapel->semester . '</b> berhasil ditambahkan!');
    }
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
      return view('pages.datatapel.edit',[
        'tapel' => Tapel::find($id),
      ]);
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
      $request->validate([
        'tahun_pelajaran' => 'required',
        'semester' => 'required',
      ]);
      $tapel = Tapel::find($id);
      $tapel->update($request->all());
      return redirect(route('datatapel.index'))->withSuccess('Data Tapel: <b>' . $tapel->tahun_pelajaran . ' - Semester ' . $tapel->semester . '</b> berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $tapel = Tapel::find($id);
    $tapel->delete();
    return redirect(route('datatapel.index'))->withSuccess('Data Tapel: <b>' . $tapel->tahun_pelajaran . ' Semester ' . $tapel->semester . '</b> berhasil dihapus!');
  }
}

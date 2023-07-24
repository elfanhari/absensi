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
        return view('pages.datatapel.index', compact('tapel', 'kelas'));
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
        'tapel1',
        'tapel2',
        'semester',
      ])) {
        return back()->withFailed('Formulir tidak boleh kosong!');
    }

    $request->validate([
      'tapel1' => 'required',
      'tapel2' => 'required',
      'semester' => 'required',
    ]);

    $tahun_pelajaran = Tapel::where('tahun_pelajaran', $request->tapel1 . '/' . $request->tapel2 )->get()->pluck('semester');
    $semesterUdahAda = $request->semester;

    if ($tahun_pelajaran->contains($semesterUdahAda)) {
      return back()->withFailed('Data yang ingin Anda tambahkan sudah ada!');
    } elseif ((intval($request->tapel1) + 1) !== intval($request->tapel2)){
      return back()->withFailed('Pengisian Tahun pelajaran harus sesuai ketentuan!');
    } else {
      $tapel = Tapel::create([
        'tahun_pelajaran' => $request->tapel1 . '/' . $request->tapel2,
        'semester' => $request->semester
      ]);
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
      abort('403');
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
        'tapel1' => 'required',
        'tapel2' => 'required',
        'semester' => 'required',
      ]);
      $tapel = Tapel::find($id);
      $tapel->update([
        'tahun_pelajaran' => $request->tapel1 . '/' . $request->tapel2,
        'semester' => $request->semester
      ]);
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

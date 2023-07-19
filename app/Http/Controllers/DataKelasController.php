<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tapel;
use App\Models\User;
use Illuminate\Http\Request;

class DataKelasController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->role === 'walisiswa' || auth()->user()->role === 'siswa') {
      abort('403');
    } else{
      if(auth()->user()->role === 'admin'){
        $kelas = Kelas::get();
      } else{
        $kelas = Kelas::where('guru_id', auth()->user()->guru->id)->get();
      }
      $siswa = Siswa::get();
      $role = auth()->user()->role;
      return view('pages.datakelas.index', compact('kelas', 'siswa', 'role'));
    }

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('pages.datakelas.create', [
        'guru' => Guru::doesntHave('kelas')->get(),
        'tapel' => Tapel::get(),
        'role' => auth()->user()->role,
      ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(KelasRequest $request)
  {
      Kelas::create($request->all());
      return redirect(route('datakelas.index', auth()->user()->role))->withSuccess('Data Kelas: <b>' . $request->name . '</b> berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($role, $id)
  {
      return view('pages.datakelas.show',[
        'kelas' => Kelas::find($id),
        'siswa' => Siswa::getSiswaAktifKelas($id),
        'role' => auth()->user()->role,
      ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($role, $id)
  {
    // $kelasDiEdit = ;
    // $waliKelas = Guru::whereId($kelasDiEdit->guru_id);

    return view('pages.datakelas.edit', [
      'kelas' => Kelas::find($id),
      // 'walikelas' => $waliKelas,
      'guru' => Guru::doesntHave('kelas')->get(),
      'tapel' => Tapel::get(),
      'role' => auth()->user()->role,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $role, $id)
  {
    $kelasDiEdit = Kelas::find($id);
    $request->validate([
      'name' => 'required|unique:kelas,name,' . $kelasDiEdit->id,
    ]);

    Kelas::find($id)->update($request->all());
    return redirect(route('datakelas.index', $role))->withSuccess('Data Kelas: <b>' . $request->name . '</b> berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $role, $id)
  {
      Kelas::find($id)->delete();
      return redirect(route('datakelas.index', $role))->withSuccess('Data Kelas: <b>' . $request->name . '</b> berhasil dihapus!');
  }
}

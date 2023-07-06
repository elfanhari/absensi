<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;

class AbsensiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      if(auth()->user()->role === 'admin'){
        $pembelajaran = Pembelajaran::orderBy('mapel_id', 'ASC')->get();
      } elseif(auth()->user()->role === 'guru'){
        $pembelajaran = Pembelajaran::where('guru_id', auth()->user()->guru->id)->orderBy('mapel_id', 'ASC')->get();
      } elseif(auth()->user()->role === 'siswa'){
        $pembelajaran = Pembelajaran::where('kelas_id', auth()->user()->siswa->kelas->id)->orderBy('mapel_id', 'ASC')->get();
      }

      $role = auth()->user()->role;
      $pertemuan = Pertemuan::get();
      return view('pages.absensi.index', compact('pembelajaran', 'role', 'pertemuan'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // return view('pages.absensi.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $pertemuan = Pertemuan::where('pembelajaran_id', $request->pembelajaran_id)->get()->pluck('pertemuan_ke');
    $reqPertemuanKe = intval($request->pertemuan_ke);

    $valid = $request->validate([
      'pembelajaran_id' => 'required',
      'pertemuan_ke' => 'required',
      'tanggal' => 'required|date',
      'dari_pukul' => 'required',
      'sampai_pukul' => 'required',
    ]);

    if ($pertemuan->contains($reqPertemuanKe)) {
      return back()->with([
        'failed' => 'Pertemuan ke ' . $reqPertemuanKe .  ' pada kelas ini sudah ada!',
      ]);
    }

    if (!$valid) {
      return back()->with([
        'failed' => 'Permintaan gagal diproses, silahkan cek formulir kembali!',
      ]);

    } else {
      Pertemuan::create($request->all());
      return back()
        ->withSuccess('Pertemuan ke-' . $reqPertemuanKe . ' berhasil ditambahkan!');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($role, $id)
  {
    $pembelajaran = Pembelajaran::find($id);

    if (auth()->user()->role == 'siswa') {
      $siswa = Siswa::where('user_id', auth()->user()->id)->get();
    } else {
      $siswa = Siswa::where('kelas_id', $pembelajaran->kelas_id)->get();
    }
    return view('pages.absensi.show', [
      'pembelajaran' => $pembelajaran,
      'siswa' => $siswa,
      'pertemuan' => Pertemuan::where('pembelajaran_id', $id)->orderBy('pertemuan_ke', 'ASC')->get(),
      'absen' => Absen::get(),
      'role' => auth()->user()->role,
    ]);
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
  public function update(Request $request, $role, $id)
  {
    $lastPertemuanKe = Pertemuan::whereId($id)->get()->pluck('pertemuan_ke');
    $pertemuan = Pertemuan::where('pembelajaran_id', $request->pembelajaran_id)->where('pertemuan_ke', '!=' , $lastPertemuanKe)->get()->pluck('pertemuan_ke');
    $reqPertemuanKe = intval($request->pertemuan_ke);

    $valid = $request->validate([
      'pembelajaran_id' => 'required',
      'pertemuan_ke' => 'required',
      'tanggal' => 'required|date',
      'dari_pukul' => 'required',
      'sampai_pukul' => 'required',
    ]);

    if ($pertemuan->contains($reqPertemuanKe)) {
      return back()->with([
        'failed' => 'Pertemuan ke ' . $reqPertemuanKe .  ' pada kelas ini sudah ada!',
      ]);
    }

    if (!$valid) {
      return back()->with([
        'failed' => 'Permintaan gagal diproses, silahkan cek formulir kembali!',
      ]);

    } else {
      Pertemuan::whereId($id)->update($request->except(['_token', '_method']));
      return back()
        ->withSuccess('Pertemuan ke-' . $reqPertemuanKe . ' berhasil diperbarui!');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $role, $id)
  {
    Pertemuan::find($id)->delete();
    return back()->withSuccess('Pertemuan ke-' . $request->pertemuan_ke . ' berhasil dihapus!');
  }

  public function editAbsensi($role, $id) {

    $pertemuan = Pertemuan::find($id);

    return view('pages.absensi.edit', [
      'pembelajaran' => $pertemuan->pembelajaran,
      'siswa' => Siswa::where('kelas_id', $pertemuan->pembelajaran->kelas_id)->get(),
      'pertemuan' => $pertemuan,
      'absen' => Absen::where('pertemuan_id', $id)->get(),
      'role' => auth()->user()->role,
    ]);
  }

  public function updateAbsensi(Request $request, $role, $id) {
    $pertemuan = Pertemuan::find($id);
    $siswas = $request->siswa_id;
    $siswas = Siswa::whereIn('id', $siswas)->get()->pluck('id');

    foreach ($siswas as $i => $siswa) {

      $absen = Absen::whereIn('siswa_id', $siswas)->where('pertemuan_id', $pertemuan->id)->get();
      $absen = $absen->where('siswa_id', $siswa)->first();
      if ($absen) {
        $absen->update([
          'keterangan' => $request->keterangan[$i]
        ]);
      } else {
        if ($request->keterangan[$i]) {
          Absen::create([
            'siswa_id' => $siswa,
            'pertemuan_id' => $pertemuan->id,
            'keterangan' => $request->keterangan[$i]
          ]);
        }
      }
    }
    return back()->withSuccess('Data berhasil diperbarui!');
  }
}

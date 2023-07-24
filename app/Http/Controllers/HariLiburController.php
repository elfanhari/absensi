<?php

namespace App\Http\Controllers;

use App\Models\HariLibur;
use Illuminate\Http\Request;

class HariLiburController extends Controller
{
    function index() {
      if (auth()->user()->role !== 'admin') {
        abort('403');
      }
      return view('pages.dataharilibur.index', [
        'libur' => HariLibur::get(),
        'role' => auth()->user()->role
      ]);
    }

    function store(Request $request) {
      $request->validate([
        'tgl' => ['required', 'unique:hari_liburs'],
        'ket' => ['required']
      ]);

      $tgl = $request->tgl;
      $tglUdhAda = HariLibur::get()->pluck('tgl');

      if ($tglUdhAda->contains($tgl)) {
        return back()->withFailed('Tanggal yang ingin Anda tambahkan sudah diatur libur!');
      } else {
        HariLibur::create($request->all());
        return redirect(route('harilibur.index', auth()->user()->role))->withInfo('Data berhasil ditambahkan!');
      }
    }

    function destroy($role, $id) {
      HariLibur::find($id)->delete();
      return redirect(route('harilibur.index', auth()->user()->role))->withInfo('Data berhasil dihapus!');
    }
}

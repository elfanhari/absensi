<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Notifikasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.notifikasi.index', [
          'role' => Auth::user()->role,
          'siswa' => Siswa::whereHas('user', fn($q) => $q->where('is_aktif', true))->with('user', 'kelas')->orderBy('name', 'ASC')->get(),
          'guru' => Guru::where('user_id', '!=', Auth::user()->id)->whereHas('user', fn($q) => $q->where('is_aktif', true))->with('user')->orderBy('name', 'ASC')->get(),
          'admin' => Admin::where('user_id', '!=', Auth::user()->id)->whereHas('user', fn($q) => $q->where('is_aktif', true))->with('user')->orderBy('name', 'ASC')->get(),
          'allMyNotif' => Notifikasi::semuaNotifSaya(Auth::user()->id),
          'notifBelumDibaca' => Notifikasi::belumDibaca(Auth::user()->id),
          'notifTelahDibaca' => Notifikasi::telahDibaca(Auth::user()->id),
        ]);
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
        $request->validate([
          'penerima_id' => 'required',
          'judul' => 'required',
          'isi' => 'required',
          'kategori' => 'required',
        ]);

        Notifikasi::create([
          'pengirim_id' => Auth::user()->id,
          'penerima_id' => $request->penerima_id,
          'judul' => $request->judul,
          'isi' => $request->isi,
          'kategori' => $request->kategori,
        ]);

        return back()->withSuccess('Notifikasi berhasil terkirim!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
        $notif = Notifikasi::whereId($id)->first();

        if ($notif->dibaca == false) {
          $up = [ 'dibaca' => true ];
          $notif->update($up);
        }

        return view('pages.notifikasi.show', [
          'notifBelumDibaca' => Notifikasi::belumDibaca(Auth::user()->id),
          'notif' => $notif,
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
    public function destroy(Request $request, $role, $id)
    {
        if ($request->hapus_untuk == 'single') {
          Notifikasi::whereId($id)->delete();
        } else {
          Notifikasi::where('penerima_id', Auth::user()->id)->delete();
        }
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\HariLibur;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role === 'admin' || auth()->user()->role === 'piket'){
          $kelas = Kelas::with(['tapel', 'guru:id,name'])->get();
        } elseif(auth()->user()->role === 'guru'){
          $kelas = Kelas::where('guru_id', Auth::user()->guru->id)->with(['tapel', 'guru:id,name'])->get();
        } elseif(auth()->user()->role === 'siswa'){
          $kelas = Kelas::where('id', Auth::user()->siswa->kelas_id)->with(['tapel', 'guru:id,name'])->get();
        }

        return view('pages.absensi.index', [
          'kelas' => $kelas
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
      if (Auth::user()->role == 'guru') {
        if ($id != Auth::user()->guru->kelas->id) {
          abort('403');
        }
      } elseif (Auth::user()->role == 'siswa') {
        if ($id != Auth::user()->siswa->kelas_id) {
          abort('403');
        }
      }
      return view('pages.absensi.show', [
        'kelas' => Kelas::find($id),
        'role'  => Auth::user()->role,
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
    public function destroy($id)
    {
        //
    }

    public function showMonth($role, $kelas, $month)
    {
      if (Auth::user()->role == 'guru') {
        if ($kelas != Auth::user()->guru->kelas->id) {
          abort('403');
        }
      } elseif (Auth::user()->role == 'siswa') {
        if ($kelas != Auth::user()->siswa->kelas_id) {
          abort('403');
        }
      }

      $kelas = Kelas::find($kelas);

      if ($kelas->tapel->semester == 1) {
        $year = intval(Str::before($kelas->tapel->tahun_pelajaran, '/'));
      } else {
        $year = intval(Str::after($kelas->tapel->tahun_pelajaran, '/'));
      }

      $startDate = Carbon::create($year, $month, 1);
      $endDate = $startDate->copy()->endOfMonth();
      $datesInMonth = [];
      while ($startDate->lte($endDate)) {
        $datesInMonth[] = $startDate->toDateString();
        $startDate->addDay();
      }

      if (Auth::user()->role == 'siswa') {
        $siswa = Siswa::where('user_id', Auth::user()->id)->get();
      } else {
        $siswa = Siswa::getSiswaAktifKelas($kelas->id);
      }

      $siswa_id = $siswa->pluck('id');

      return view('pages.absensi.showmonth', [
        'kelas' => $kelas,
        'monthIndo' => Carbon::create()->month($month)->locale('id')->isoFormat('MMMM') . ' ' . $year,
        'month' => $month,
        'months' => $datesInMonth,
        'siswa' => $siswa,
        'role' => Auth::user()->role,
        'libur' => HariLibur::whereMonth('tgl', $month)->get(),
        'absen' => Absen::whereIn('siswa_id', $siswa_id)->where('keterangan', '!=', 'H')->whereMonth('tanggal', $month)->get(),
        'absenDiTglIni' => Absen::whereNotIn('tanggal', HariLibur::get()->pluck('tgl'))->whereIn('siswa_id', $siswa_id)->whereMonth('tanggal', $month)->distinct('tanggal')->pluck('tanggal'),
      ]);
    }

    public function getAbsensi($role, $kelas, $month, $date, $key)
    {
      if (Auth::user()->role == 'guru') {
        if ($kelas != Auth::user()->guru->kelas->id) {
          abort('403');
        }
      } elseif ($role == 'siswa') {
        abort('403');
      }

      if ($date != date('Y-m-d', Str::before($key, '_'))) {
        abort('404');
      }

      $kelas = Kelas::find($kelas);

      if ($kelas->tapel->semester == 1) {
        $year = intval(Str::before($kelas->tapel->tahun_pelajaran, '/'));
      } else {
        $year = intval(Str::after($kelas->tapel->tahun_pelajaran, '/'));
      }

      if ($year != Str::before($date, '-')) {
        abort('404');
      } else {
        $siswa = Siswa::getSiswaAktifKelas($kelas->id);
        $siswa_id = $siswa->pluck('id');
        return view('pages.absensi.kelolaabsen', [
          'siswa' => $siswa,
          'kelas' => $kelas,
          'month' => $month,
          'date'  => $date,
          'role' => Auth::user()->role,
          'absen' => Absen::whereIn('siswa_id', $siswa_id)->where('tanggal', $date)->get(),
          // 'absen' => Absen::get(),
        ]);
      }
    }

    public function putAbsensi(Request $request, $role, $kelas, $month, $date)
    {
        $siswas = $request->siswa_id;
        $siswas = Siswa::whereIn('id', $siswas)->pluck('id');

        foreach ($siswas as $i => $siswaId) {
            $absen = Absen::where('siswa_id', $siswaId)
                ->where('tanggal', $date)
                ->first();

            if ($request->keterangan[$i]) {
                if ($absen) {
                    $absen->update([
                        'keterangan' => $request->keterangan[$i]
                    ]);
                } else {
                    Absen::create([
                        'siswa_id' => $siswaId,
                        'tanggal' => $date,
                        'keterangan' => $request->keterangan[$i]
                    ]);
                }
            } elseif ($absen) {
                $absen->delete();
            }
        }

        return redirect(route('absensi.kelas.month', [$role, $kelas, $month]))
            ->withSuccess('Data berhasil diperbarui!');

    }

}

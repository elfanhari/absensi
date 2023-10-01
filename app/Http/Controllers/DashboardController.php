<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Siswa;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('pages.dashboard.index',[
          'siswa' => Siswa::count(),
          'guru' => Guru::count(),
          'admin' => Admin::count(),
          'kelas' => Kelas::count(),
          'tapel' => Tapel::count(),
          'role' => Auth::user()->role,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function __invoke() {
      $kelas = Kelas::select('id', 'name')->orderBy('name', 'ASC')->get();

      return view('welcome', [
          'kelas' => $kelas,
          // 'tanggal' => date('Y-m-d'),
          'tanggal' => date('2023-10-02')
      ]);
  }
}

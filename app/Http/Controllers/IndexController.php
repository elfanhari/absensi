<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke() {
      return view('welcome', [
        'kelas' => Kelas::orderBy('name', 'ASC')->get(),
        'tanggal' => date('Y-m-d'),
      ]);
    }

}

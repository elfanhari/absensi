<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('pages.auth.login2');
  }

  public function cekLogin(Request $request)
  {
    $input = $request->validate([
      'username' => ['required'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($input)) {
      $role = auth()->user()->role;
      return redirect( $role . '/dashboard')->with('login', $role);
    } else {
      return back()->withInfo('Username atau password salah!');
    }
  }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuruRequest;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


class DataGuruController extends Controller
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
      }
      return view('pages.dataguru.index', [
        'guru' => Guru::orderBy('name', 'ASC')->get(),
        'kelas' => Kelas::get(),
        'role' => Auth::user()->role,
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      if(auth()->user()->role !== 'admin'){
        abort('403');
      }
      $role = auth()->user()->role;
      return view('pages.dataguru.create', compact('role'));
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
        'name'      => 'required',
        'jk'        => 'required',
        'username'   => 'required|unique:users',
        'password'   => 'required',
      ]);

      $inputUser = User::create([
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'role' => 'guru',
      ]);
      $inputUser; // Create User

      $request['user_id'] = $inputUser->id;
      $inputGuru = $request->except(['_token', '_method', 'username', 'password']);
      Guru::create($inputGuru);
      return redirect(route('dataguru.index', auth()->user()->role))->with([
        'success' => 'Data Guru: <b>' . $request->name . '</b> berhasil ditambahkan!',
        'role' => auth()->user()->role,
      ]);
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
  public function edit($role, $id)
  {
      if(auth()->user()->role !== 'admin'){
        abort('403');
      }
      $guru = Guru::find($id);
      $role = auth()->user()->role;
      $urlSebelumnya = URL::previous();
      return view('pages.dataguru.edit', compact('guru', 'role', 'urlSebelumnya'));
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
    $guru = Guru::find($id);
    $request->validate([
      'name'      => 'required',
      'jk'        => 'required',
      'is_aktif'   => 'required',
      'username'   => 'required|unique:users,username,' . $guru->user_id,
    ]);

    if ($request->filled('password')) {
        $guru->update($request->except('is_aktif', 'username', 'password'));
        User::where('id', $guru->user_id)->update([
          'is_aktif' => $request->is_aktif,
          'username' => $request->username,
          'password' => bcrypt($request->password),
        ]);
    } else {
        $guru->update($request->except('is_aktif', 'username', 'password'));
        User::where('id', $guru->user_id)->update([
          'is_aktif' => $request->is_aktif,
          'username' => $request->username,
        ]);
    }

    return redirect(route('dataguru.index', auth()->user()->role))->with([
      'success' => 'Data Guru: <b>' . $request->name . '</b> berhasil diperbarui!',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $id)
  {
    User::where('id', $request->user_id)->delete();
    return redirect(route('dataguru.index', auth()->user()->role))->withSuccess('Data Guru: <b>' . $request->name . '</b> berhasil dihapus!');
  }
}

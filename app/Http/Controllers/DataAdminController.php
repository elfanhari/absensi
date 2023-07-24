<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAdminController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      if (auth()->user()->role !== 'admin') {
        abort('403');
      } else{
        return view('pages.dataadmin.index', [
          'admin' => Admin::orderBy('name', 'ASC')->get(),
          'role' => Auth::user()->role,
        ]);
      }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $role = auth()->user()->role;
      return view('pages.dataadmin.create', compact('role'));
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
        'role' => 'admin',
      ]);
      $inputUser; // Create User

      $request['user_id'] = $inputUser->id;
      $inputAdmin = $request->except(['_token', '_method', 'username', 'password']);
      Admin::create($inputAdmin);
      return redirect(route('dataadmin.index', auth()->user()->role))
      ->with([
        'success' => 'Data Admin: <b>' . $request->name . '</b> berhasil ditambahkan!',
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
      $admin = Admin::find($id);
      $role = auth()->user()->role;
      return view('pages.dataadmin.edit', compact('admin', 'role'));
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
    $admin = Admin::find($id);
    $request->validate([
      'name'      => 'required',
      'jk'        => 'required',
      'is_aktif'   => 'required',
      'username'   => 'required|unique:users,username,' . $admin->user_id,
    ]);

    if ($request->filled('password')) {
        $admin->update($request->except('is_aktif', 'username', 'password'));
        User::where('id', $admin->user_id)->update([
          'is_aktif' => $request->is_aktif,
          'username' => $request->username,
          'password' => bcrypt($request->password),
        ]);
    } else {
        $admin->update($request->except('is_aktif', 'username', 'password'));
        User::where('id', $admin->user_id)->update([
          'is_aktif' => $request->is_aktif,
          'username' => $request->username,
        ]);
    }

    return redirect(route('dataadmin.index', auth()->user()->role))->with([
      'success' => 'Data Admin: <b>' . $request->name . '</b> berhasil diperbarui!',
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
    return redirect(route('dataadmin.index', auth()->user()->role))->withSuccess('Data Admin: <b>' . $request->name . '</b> berhasil dihapus!');
  }
}

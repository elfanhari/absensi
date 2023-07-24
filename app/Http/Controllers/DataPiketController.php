<?php

namespace App\Http\Controllers;

use App\Models\Piket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataPiketController extends Controller
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
        return view('pages.datapiket.index', [
          'piket' => Piket::orderBy('name', 'ASC')->get(),
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
      if(auth()->user()->role !== 'admin'){
        abort('403');
      }
      $role = auth()->user()->role;
      return view('pages.datapiket.create', compact('role'));
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
        'username'   => 'required|unique:users',
        'password'   => 'required',
      ]);

      $inputUser = User::create([
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'role' => 'piket',
      ]);
      $inputUser; // Create User

      $request['user_id'] = $inputUser->id;
      $inputPiket = $request->except(['_token', '_method', 'username', 'password']);
      Piket::create($inputPiket);
      return redirect(route('datapiket.index', auth()->user()->role))->with([
        'success' => 'Data Piket berhasil ditambahkan!',
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
      $piket = Piket::find($id);
      $role = auth()->user()->role;
      // $urlSebelumnya = URL::previous();
      return view('pages.datapiket.edit', compact('piket', 'role'));
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
    $piket = Piket::find($id);
    $request->validate([
      'name'      => 'required',
      'is_aktif'   => 'required',
      'username'   => 'required|unique:users,username,' . $piket->user_id,
    ]);

    if ($request->filled('password')) {
        $piket->update($request->except('is_aktif', 'username', 'password'));
        User::where('id', $piket->user_id)->update([
          'is_aktif' => $request->is_aktif,
          'username' => $request->username,
          'password' => bcrypt($request->password),
        ]);
    } else {
        $piket->update($request->except('is_aktif', 'username', 'password'));
        User::where('id', $piket->user_id)->update([
          'is_aktif' => $request->is_aktif,
          'username' => $request->username,
        ]);
    }

    return redirect(route('datapiket.index', auth()->user()->role))->with([
      'success' => 'Data Piket berhasil diperbarui!',
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
    return redirect(route('datapiket.index', auth()->user()->role))->withSuccess('Data Piket berhasil dihapus!');
  }
}

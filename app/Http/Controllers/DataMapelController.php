<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Tapel;
use Illuminate\Http\Request;

class DataMapelController extends Controller
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
    } else{
      $mapel = Mapel::get();
      $pembelajaran = Pembelajaran::get();
      return view('pages.datamapel.index', compact('mapel', 'pembelajaran'));
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('pages.datamapel.create', [
      'tapel' => Tapel::orderBy('tahun_pelajaran', 'ASC')->orderBy('semester')->get(),
    ]);
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
      'name' => 'required|unique:mapels',
      'singkatan' => 'required',
    ]);
    Mapel::create($request->all());
    return redirect(route('datamapel.index'))->withSuccess('Data Mapel: <b>' . $request->name . '</b> berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      return view('pages.datamapel.show',[
        'mapel' => Mapel::find($id),
        'pembelajaran' => Pembelajaran::where('mapel_id', $id)->get(),
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
    return view('pages.datamapel.edit', [
      'mapel' => Mapel::find($id),
      'tapel' => Tapel::get(),
    ]);
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
    $mapelDiEdit = Mapel::find($id);
    $request->validate([
      'name' => 'required|unique:mapels,name,' . $mapelDiEdit->id,
      'singkatan' => 'required',
    ]);

    $mapelDiEdit->update($request->all());
    return redirect(route('datamapel.index'))->withSuccess('Data Mapel: <b>' . $request->name . '</b> berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $id)
  {
    Mapel::find($id)->delete();
    return redirect(route('datamapel.index'))->withSuccess('Data Mapel: <b>' . $request->name . '</b> berhasil dihapus!');
  }
}

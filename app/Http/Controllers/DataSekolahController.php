<?php

namespace App\Http\Controllers;

use App\Http\Requests\SekolahRequest;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DataSekolahController extends Controller
{
    public function index(Request $request) {
      if (auth()->user()->role !== 'admin') {
        abort('403');
      } else{
        $sekolah = Sekolah::first();
        return view('pages.datasekolah.index', compact('sekolah'));
      }
    }

    public function store(SekolahRequest $request) {
      Sekolah::create($request->all());
      return redirect(route('datasekolah.index'))->withSuccess('Data Sekolah berhasil dibuat!');
    }

    public function update(SekolahRequest $request, $id) {
      Sekolah::find($id)->update($request->all());
      return redirect(route('datasekolah.index'))->withSuccess('Data Sekolah berhasil diperbarui!');
    }

    public function updateLogo(Request $request, $id) {
      $request->validate([
        'files' => ['image', 'required'],
      ]);

      $files = $request->file('files');
      if ($request->hasFile('files')) {
        $filenameWithExtension      = $request->file('files')->getClientOriginalExtension();
        $filename                   = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension                  = $files->getClientOriginalExtension();
        $filenamesimpan             = 'logo' . time() . Str::random(10) . '.' . $extension;
        $files->move('img', $filenamesimpan);

        $editdata = [
          'logo' => $filenamesimpan,
        ];

        Sekolah::find($id)->update($editdata);
      }

      if ($request->old_logo != 'logo.png'){
        $filegambar = public_path('/img/' . $request->old_logo);
        File::delete($filegambar);
      }

      return back()->withSuccess('Logo sekolah berhasil diperbarui!');

    }
}

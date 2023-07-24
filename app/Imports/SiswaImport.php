<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;

class SiswaImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $existingUser = User::where('username', $row[0])->first();
      if ($existingUser) {
          return back()->withFailed('Gagal!');
      }

      $existingEmail = User::where('email', $row[1])->first();
      if ($existingEmail) {
        return back()->withFailed('Gagal!');
      }

      $user = User::create([
        'username' => $row[8],
        'email' => $row[7],
        'role' => 'siswa', // Anda bisa mengganti role sesuai kebutuhan
        'password' => bcrypt($row[9]), // Anda bisa mengubah cara enkripsi password sesuai konfigurasi
      ]);

      // Menyimpan data ke dalam tabel siswas
      $siswa = new Siswa([
          'user_id' => $user->id,
          'kelas_id' => $row[0],
          'name' => $row[3],
          'nis' => $row[2],
          'nisn' => $row[1],
          'jk' => $row[4],
          'telepon' => $row[5],
          'alamat' => $row[6],
      ]);

      // $existingUser = User::where('username', $user->username)->orWhere('email', $user->email)->first();
      // $existingSiswa = Siswa::where('nis', $siswa->nis)->orWhere('nisn', $siswa->nisn)->first();
      // if ($existingSiswa) {
      //     throw new \Exception("Siswa dengan NIS/NISN: {$siswa->nis}/{$siswa->nisn} sudah ada dalam database.");
      // }

      $siswa->save();
      return $siswa;
    }

    // Tentukan baris pertama data yang akan diimpor (misalnya, baris judul tidak diimpor)
    public function startRow(): int
    {
        return 5;
    }
}

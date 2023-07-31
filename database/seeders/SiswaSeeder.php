<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      collect([
        [
          'user_id' => 7,
          'kelas_id' => 1,
          'name' => 'Elfan',
          'jk' => 'L',
          'nis' => '024342412',
          'nisn' => '3035423424',
          'alamat' => 'Lakbok',
          'telepon' => '081234567890',
        ],
        [
          'user_id' => 8,
          'kelas_id' => 1,
          'name' => 'Bunga',
          'jk' => 'P',
          'nis' => '024342121',
          'nisn' => '3035423409',
          'alamat' => 'Lakbok',
          'telepon' => '081234567891',
        ],
        [
          'user_id' => 9,
          'kelas_id' => 2,
          'name' => 'Teguh',
          'jk' => 'L',
          'nis' => '024342410',
          'nisn' => '3035423429',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
        [
          'user_id' => 10,
          'kelas_id' => 3,
          'name' => 'Alfitka',
          'jk' => 'L',
          'nis' => '024342098',
          'nisn' => '3030923424',
          'alamat' => 'Lakbok',
          'telepon' => '081234567850',
        ],
        [
          'user_id' => 11,
          'kelas_id' => 1,
          'name' => 'Andre',
          'jk' => 'L',
          'nis' => '024342401',
          'nisn' => '3035422401',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
        [
          'user_id' => 12,
          'kelas_id' => 1,
          'name' => 'Renal',
          'jk' => 'L',
          'nis' => '024342402',
          'nisn' => '3035422403',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
        [
          'user_id' => 13,
          'kelas_id' => 1,
          'name' => 'Dimas',
          'jk' => 'L',
          'nis' => '024342404',
          'nisn' => '3035422213',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
        [
          'user_id' => 14,
          'kelas_id' => 1,
          'name' => 'Rafli',
          'jk' => 'L',
          'nis' => '024342406',
          'nisn' => '3035422406',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
        [
          'user_id' => 15,
          'kelas_id' => 1,
          'name' => 'Khikmal',
          'jk' => 'L',
          'nis' => '024342407',
          'nisn' => '3035422407',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
        [
          'user_id' => 16,
          'kelas_id' => 1,
          'name' => 'Trio',
          'jk' => 'L',
          'nis' => '024342408',
          'nisn' => '3035422408',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
        [
          'user_id' => 17,
          'kelas_id' => 1,
          'name' => 'Dwi',
          'jk' => 'P',
          'nis' => '024342409',
          'nisn' => '3035422409',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
        [
          'user_id' => 18,
          'kelas_id' => 1,
          'name' => 'Rifaul',
          'jk' => 'P',
          'nis' => '024112410',
          'nisn' => '3030422410',
          'alamat' => 'Lakbok',
          'telepon' => '081234567893',
        ],
      ])->each(function($siswa){
        Siswa::create($siswa);
      });

      // collect([
      //   [
      //     [
      //       'user_id' => 3,
      //       'kelas_id' => 1,
      //       'name' => 'Elfan Hari Saputra',
      //       'jk' => 'L',
      //       'nis' => '024342412',
      //       'nisn' => '3035423424',
      //       'alamat' => 'Lakbok',
      //       'telepon' => '081234567890',
      //     ],
      //   ],
      // ])->each(function($siswa){
      //   Siswa::create($siswa);
      // });
    }
}

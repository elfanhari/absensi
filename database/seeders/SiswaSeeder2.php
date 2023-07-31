<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder2 extends Seeder
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
              'user_id' => 3,
              'kelas_id' => 1,
              'name' => 'Elfan Hari Saputra',
              'jk' => 'L',
              'nis' => '024342412',
              'nisn' => '3035423424',
              'alamat' => 'Lakbok',
              'telepon' => '081234567890',
            ],
        ])->each(function($siswa){
          Siswa::create($siswa);
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
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
          'name' => 'MTs Rekayasa',
          'npsn' => '10900867',
          // 'nss' => '',
          'telepon' => '081234567890',
          'email' => 'mtsrekayasa@gmail.com',
          'alamat' => 'Jl. Raya Indonesia',
          'kodepos' => '46385',
          'website' => 'mtsrekayasa.sch.id',
          'kepsek' => 'Maman Sudirman, S. Pd',
          'nipkepsek' => '19800202 200604 1 008',
        ],
      ])->each(function($sekolah){
        Sekolah::create($sekolah);
      });
    }
}

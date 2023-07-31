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
          'name' => 'MTsN 27 Jakarta',
          'npsn' => '10900867',
          // 'nss' => '',
          'telepon' => '081234567890',
          'email' => 'mtsn27jakarta@gmail.com',
          'alamat' => 'Jl. Raya Jakarta',
          'kodepos' => '46385',
          'website' => 'mtsn27-jakbar.sch.id',
          'kepsek' => 'Siti Awaliyah, S. Pd',
          'nipkepsek' => '19800202 200604 1 008',
        ],
      ])->each(function($sekolah){
        Sekolah::create($sekolah);
      });
    }
}

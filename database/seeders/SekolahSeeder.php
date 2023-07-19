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
          'npsn' => '69354090',
          'nss' => '12345678',
          'telepon' => '02652701285',
          'email' => 'mts-rekayasa@gmail.com',
          'alamat' => 'Jl. Raya Indonesia, Banjar',
          'kodepos' => '46385',
          'website' => 'www.mts-rekayasa.sch.id',
          'kepsek' => 'Deni Ramdani, M.M',
          'nipkepsek' => '197607092004015009',
        ],
      ])->each(function($sekolah){
        Sekolah::create($sekolah);
      });
    }
}

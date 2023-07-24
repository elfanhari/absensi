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
          'name' => 'SMK NEGERI 54 JAKARTA',
          'npsn' => '20100156',
          // 'nss' => '12345678',
          'telepon' => '(021) 4248741',
          'email' => 'info@smkn54jkt.sch.id',
          'alamat' => 'Jl.Bend. Jago No.53, RT.14/RW.1, Serdang, Kec. Kemayoran, Kota Jakarta Pusat, DKI Jakarta',
          'kodepos' => '10650',
          'website' => 'smkn54jkt.sch.id',
          'kepsek' => 'Hamidah Nasir, S.Pd',
          'nipkepsek' => '197607092004015009',
        ],
      ])->each(function($sekolah){
        Sekolah::create($sekolah);
      });
    }
}

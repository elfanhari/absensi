<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder2 extends Seeder
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
          'name' => 'Teknik Pendingin Tata Udara',
          'singkatan' =>'TPTU'
        ],
        [
          'name' =>'Teknik Kendaraan Ringan Otomotif',
          'singkatan' =>'TKRO'
        ],
        [
          'name' =>'Teknik Jaringan Komputer & Telekomunikasi',
          'singkatan' =>'TKJ'
        ],
      ])->each(function($jurusan){
        Jurusan::create($jurusan);
      });
    }
}

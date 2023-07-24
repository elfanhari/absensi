<?php

namespace Database\Seeders;

use App\Models\Tapel;
use Illuminate\Database\Seeder;

class TapelSeeder2 extends Seeder
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
          'tahun_pelajaran' => '2023/2024',
          'semester' => 1,
        ],
      ])->each(function($tapel){
        Tapel::create($tapel);
      });
    }
}

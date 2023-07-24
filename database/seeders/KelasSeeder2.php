<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder2 extends Seeder
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
          'tapel_id' => 1,
          'jurusan_id' => 3,
          'guru_id' => 1,
          'tingkat' => 10,
          'name' =>'X TKJ 1'
        ],
      ])->each(function($kelas){
        Kelas::create($kelas);
      });
    }
}

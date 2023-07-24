<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
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
          'jurusan_id' => 2,
          'guru_id' => 1,
          'tingkat' => 12,
          'name' =>'XII TKRO 1'
        ],
        [
          'tapel_id' => 1,
          'jurusan_id' => 1,
          'guru_id' => 2,
          'tingkat' => 11,
          'name' =>'XI TPTU 1'
        ],
        [
          'tapel_id' => 1,
          'jurusan_id' => 3,
          'guru_id' => 3,
          'tingkat' => 10,
          'name' =>'X TKJ 1'
        ],
      ])->each(function($kelas){
        Kelas::create($kelas);
      });
    }
}

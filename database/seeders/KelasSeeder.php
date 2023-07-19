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
          'guru_id' => 1,
          'tingkat' => 9,
          'name' =>'IX A'
        ],
        [
          'tapel_id' => 1,
          'guru_id' => 2,
          'tingkat' => 8,
          'name' =>'VIII A'
        ],
        [
          'tapel_id' => 1,
          'guru_id' => 3,
          'tingkat' => 7,
          'name' =>'VII A'
        ],
      ])->each(function($kelas){
        Kelas::create($kelas);
      });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder2 extends Seeder
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
          'user_id' => 2,
          'name' => 'Budi Santoso, S.Pd',
          'nip' => '768429153625071928',
          'nuptk' => '5418907265389742',
          'jk' => 'L',
          'telepon' => '08231312123',
          'alamat' => 'Langensari, Banjar',
        ],
      ])->each(function($guru){
        Guru::create($guru);
      });
    }
}

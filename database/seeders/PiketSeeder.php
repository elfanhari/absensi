<?php

namespace Database\Seeders;

use App\Models\Piket;
use Illuminate\Database\Seeder;

class PiketSeeder extends Seeder
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
          'user_id' => 25,
          'name' => 'Nama Piket 1',
        ],
        [
          'user_id' => 26,
          'name' => 'Nama Piket 1',
        ],
      ])->each(function($piket){
        Piket::create($piket);
      });
    }
}

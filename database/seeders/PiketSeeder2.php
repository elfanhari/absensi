<?php

namespace Database\Seeders;

use App\Models\Piket;
use Illuminate\Database\Seeder;

class PiketSeeder2 extends Seeder
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
          'user_id' => 3,
          'name' => 'Akun Piket',
        ],
      ])->each(function($piket){
        Piket::create($piket);
      });
    }
}

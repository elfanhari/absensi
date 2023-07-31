<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\HariLibur;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
          // UserSeeder::class,
          // TapelSeeder::class,
          // AdminSeeder::class,
          // GuruSeeder::class,
          // JurusanSeeder::class,
          // KelasSeeder::class,
          // SiswaSeeder::class,
          // SekolahSeeder::class,
          // NotifikasiSeeder::class,
          // PiketSeeder::class,
          // HariLiburSeeder::class,

          UserSeeder2::class,
          AdminSeeder2::class,
          GuruSeeder2::class,
          PiketSeeder2::class,
          TapelSeeder2::class,
          KelasSeeder2::class,
          SiswaSeeder2::class,
          SekolahSeeder::class,
        ]);
    }
}

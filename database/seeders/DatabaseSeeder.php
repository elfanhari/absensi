<?php

namespace Database\Seeders;

use App\Models\Admin;
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
          UserSeeder::class,
          TapelSeeder::class,
          AdminSeeder::class,
          GuruSeeder::class,
          KelasSeeder::class,
          SiswaSeeder::class,
          SekolahSeeder::class,
          MapelSeeder::class,
          PembelajaranSeeder::class,
          PertemuanSeeder::class,
          NotifikasiSeeder::class,
        ]);
    }
}

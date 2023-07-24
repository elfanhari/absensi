<?php

namespace Database\Seeders;

use App\Models\HariLibur;
use Illuminate\Database\Seeder;

class HariLiburSeeder extends Seeder
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
            'tgl' => '2023-07-19',
            'ket' => 'Tahun Baru Islam',
          ],
          [
            'tgl' => '2023-08-17',
            'ket' => 'Hari Kemerdekaan Republik Indonesia',
          ],
          [
            'tgl' => '2023-09-28',
            'ket' => 'Maulid Nabi Muhammad SAW',
          ],
        ])->each(fn($q) => HariLibur::create($q));
    }
}

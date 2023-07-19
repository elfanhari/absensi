<?php

namespace Database\Seeders;

use App\Models\Pertemuan;
use Illuminate\Database\Seeder;

class PertemuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      collect([
        [ // 1
          'pembelajaran_id' => 15,
          'pertemuan_ke' => 1,
          'tanggal' => '2023-07-17',
          'dari_pukul' => '07:30',
          'sampai_pukul' => '08:30',
        ],
        [ // 1
          'pembelajaran_id' => 15,
          'pertemuan_ke' => 2,
          'tanggal' => '2023-07-20',
          'dari_pukul' => '10:45',
          'sampai_pukul' => '11:30',
        ],
        [ // 1
          'pembelajaran_id' => 15,
          'pertemuan_ke' => 3,
          'tanggal' => '2023-07-24',
          'dari_pukul' => '07:30',
          'sampai_pukul' => '08:30',
        ],
        [ // 1
          'pembelajaran_id' => 15,
          'pertemuan_ke' => 4,
          'tanggal' => '2023-07-27',
          'dari_pukul' => '10:45',
          'sampai_pukul' => '11:30',
        ],

        [ // 1
          'pembelajaran_id' => 16,
          'pertemuan_ke' => 1,
          'tanggal' => '2023-07-18',
          'dari_pukul' => '08:30',
          'sampai_pukul' => '09:30',
        ],
        [ // 1
          'pembelajaran_id' => 17,
          'pertemuan_ke' => 1,
          'tanggal' => '2023-07-18',
          'dari_pukul' => '10:45',
          'sampai_pukul' => '11:30',
        ],

      ])->each(function($pembelajaran){
        Pertemuan::create($pembelajaran);
      });
    }
}

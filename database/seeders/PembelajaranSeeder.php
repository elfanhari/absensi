<?php

namespace Database\Seeders;

use App\Models\Pembelajaran;
use Illuminate\Database\Seeder;

class PembelajaranSeeder extends Seeder
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
          'kelas_id' => 1,
          'mapel_id' => 1,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 2,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 3,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 4,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 5,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 6,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 7,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 8,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 9,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 10,
          'guru_id' => 1,
        ],
        [ // B.Inggris IX A
          'kelas_id' => 1,
          'mapel_id' => 11,
          'guru_id' => 2,
        ],
        [ // Seni Budaya IX A
          'kelas_id' => 1,
          'mapel_id' => 12,
          'guru_id' => 3,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 13,
          'guru_id' => 1,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 14,
          'guru_id' => 1,
        ],
        [ // TIK IX A
          'kelas_id' => 1,
          'mapel_id' => 15,
          'guru_id' => 5,
        ],
        [ // TIK VII A
          'kelas_id' => 3,
          'mapel_id' => 15,
          'guru_id' => 5,
        ],
        [ // TIK VI A
          'kelas_id' => 2,
          'mapel_id' => 15,
          'guru_id' => 5,
        ],
        [ // 1
          'kelas_id' => 1,
          'mapel_id' => 16,
          'guru_id' => 1,
        ],
        [ // Prakarya VII A
          'kelas_id' => 3,
          'mapel_id' => 14,
          'guru_id' => 1,
        ],
        [ // Prakarya VIII A
          'kelas_id' => 2,
          'mapel_id' => 14,
          'guru_id' => 1,
        ],
        [ // B.Inggris VII A
          'kelas_id' => 3,
          'mapel_id' => 11,
          'guru_id' => 2,
        ],
        [ // B.Inggris VIII A
          'kelas_id' => 2,
          'mapel_id' => 11,
          'guru_id' => 2,
        ],
      ])->each(function($pembelajaran){
        Pembelajaran::create($pembelajaran);
      });
    }
}

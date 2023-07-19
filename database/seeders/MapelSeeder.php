<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
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
          'name' => "Al-Quran Hadist",
          'singkatan' => 'Qurdis',
        ],
        [
          'name' => 'Akidah Akhlak',
          'singkatan' => 'Aqidah',
        ],
        [
          'name' => 'Fikih',
          'singkatan' => 'Fikih',
        ],
        [
          'name' => 'Sejarah Kebudayaan Islam',
          'singkatan' => 'SKI',
        ],
        [
          'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
          'singkatan' => 'PPKn',
        ],
        [
          'name' => 'Bahasa Indonesia',
          'singkatan' => 'B. Indo',
        ],
        [
          'name' => 'Bahasa Arab',
          'singkatan' => 'B. Arab',
        ],
        [
          'name' => 'Matematika',
          'singkatan' => 'MTK',
        ],
        [
          'name' => 'Ilmu Pengetahuan Alam',
          'singkatan' => 'IPA',
        ],
        [
          'name' => 'Ilmu Pengetahuan Sosial',
          'singkatan' => 'IPS',
        ],
        [
          'name' => 'Bahasa Inggris',
          'singkatan' => 'B. Inggris',
        ],
        [
          'name' => 'Seni Budaya',
          'singkatan' => 'SB',
        ],
        [
          'name' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan',
          'singkatan' => 'PJOK',
        ],
        [
          'name' => 'Prakarya',
          'singkatan' => 'Prakarya',
        ],
        [
          'name' => 'Teknologi Informasi dan Komunikasi',
          'singkatan' => 'TIK',
        ],
        [
          'name' => 'Bahasa Sunda',
          'singkatan' => 'B. Sunda',
        ],
      ])->each(function($mapel){
        Mapel::create($mapel);
      });
    }
}

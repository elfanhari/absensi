<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
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
          'name' => 'Budi Santoso, S.Pd',
          'nip' => '768429153625071928',
          'nuptk' => '5418907265389742',
          'jk' => 'L',
          'telepon' => '08231312123',
          'alamat' => 'Langensari, Banjar',
        ],
        [
          'user_id' => 4,
          'name' => 'Dewi Rahmawati, S.Pd.I',
          // 'nip' => '01342342134',
          'nuptk' => '8742950136758296',
          'jk' => 'P',
          'telepon' => '08231312131',
          'alamat' => 'Purwaharja, Banjar',
        ],
        [
          'user_id' => 5,
          'name' => 'Iwan Setiawan, S.Pd',
          // 'nip' => '01342013034',
          'nuptk' => '2095638471985236',
          'jk' => 'L',
          'telepon' => '08231312131',
          'alamat' => 'Langkaplancar, Ciamis',
        ],
        [ //
          'user_id' => 6,
          'name' => 'Siti Rahayu, S.Pd.I',
          'nip' => '768429153625071928',
          'nuptk' => '8742950136758296',
          'jk' => 'P',
          'telepon' => '08231312131',
          'alamat' => 'Cihampelas, Bandung',
        ],
        [ //
          'user_id' => 19,
          'name' => 'Hadi Pratama, S.T',
          'nip' => '768429153625071928',
          'nuptk' => '8742950136758296',
          'jk' => 'L',
          'telepon' => '08231312131',
          'alamat' => 'Cihampelas, Bandung',
        ],
        [ //
          'user_id' => 20,
          'name' => 'Indah Nurul, S.Pd',
          'nip' => '768429153625071928',
          'nuptk' => '8742950136758296',
          'jk' => 'P',
          'telepon' => '08231312131',
          'alamat' => 'Cihampelas, Bandung',
        ],
        [ //
          'user_id' => 21,
          'name' => 'Slamet Riyadi, S.Pd.I',
          'nip' => '768429153625071928',
          'nuptk' => '8742950136758296',
          'jk' => 'L',
          'telepon' => '08231312131',
          'alamat' => 'Cihampelas, Bandung',
        ],
        [ //
          'user_id' =>22,
          'name' => 'Tri Wulandari, S.Pd.I',
          'nip' => '768429153625071928',
          'nuptk' => '8742950136758296',
          'jk' => 'P',
          'telepon' => '08231312131',
          'alamat' => 'Cihampelas, Bandung',
        ],
        [ //
          'user_id' => 23,
          'name' => 'Ahmad Subagyo, S.Pd',
          'nip' => '768429153625071928',
          'nuptk' => '8742950136758296',
          'jk' => 'L',
          'telepon' => '08231312131',
          'alamat' => 'Cihampelas, Bandung',
        ],
        [ //
          'user_id' => 24,
          'name' => 'Titin Wulandari, S.Pd',
          'nip' => '768429153625071928',
          'nuptk' => '8742950136758296',
          'jk' => 'P',
          'telepon' => '08231312131',
          'alamat' => 'Cihampelas, Bandung',
        ],
      ])->each(function($guru){
        Guru::create($guru);
      });

      // collect([
      //   [
      //     [
      //       'user_id' => 2,
      //       'name' => 'Budi Santoso, S.Pd',
      //       'nip' => '768429153625071928',
      //       'nuptk' => '5418907265389742',
      //       'jk' => 'L',
      //       'telepon' => '08231312123',
      //       'alamat' => 'Langensari, Banjar',
      //     ],
      //   ],
      // ])->each(function($guru){
      //   Guru::create($guru);
      // });

    }
}

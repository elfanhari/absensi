<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
            'user_id' => 1,
            'name' => 'Maman Suparman, S.T',
            // 'nip' => '431209874356980765',
            'nuptk' => '9821476053629418',
            'jk' => 'L',
            'telepon' => '082480143489',
            'alamat' => 'Lakbok, Ciamis',
          ],
        ])->each(function ($admin) {
          Admin::create($admin);
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      collect([
        [ //1
          'username' => 'erikadmin',
          'email' => 'erikadmin@gmail.com',
          'role' => 'admin',
          'password' => bcrypt('password'),
        ],
        [ //2
          'username' => 'budiguru',
          'email' => 'budiguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //3
          'username' => 'piket',
          'email' => 'piket@gmail.com',
          'role' => 'piket',
          'password' => bcrypt('password'),
        ],
        [ //4
          'username' => 'elfansiswa',
          'email' => 'elfan@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
      ])->each(function($user){
        User::create($user);
      });
    }
}

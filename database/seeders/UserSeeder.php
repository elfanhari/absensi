<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
          'username' => 'elfinadmin',
          'email' => 'elfinadmin@gmail.com',
          'role' => 'admin',
          'password' => bcrypt('password'),
        ],
        [ //3
          'username' => 'budiguru',
          'email' => 'budiguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //4
          'username' => 'dewiguru',
          'email' => 'dewiguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //5
          'username' => 'iwanguru',
          'email' => 'iwanguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //6
          'username' => 'sitiguru',
          'email' => 'siti@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //7
          'username' => 'elfansiswa',
          'email' => 'elfan@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //8
          'username' => 'mellasiswa',
          'email' => 'mella@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //9
          'username' => 'teguhsiswa',
          'email' => 'teguh@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //10
          'username' => 'alfitkasiswa',
          'email' => 'alfitka@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //11
          'username' => 'andre',
          'email' => 'andre@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //12
          'username' => 'renal',
          'email' => 'renal@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //13
          'username' => 'dimas',
          'email' => 'dimas@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //14
          'username' => 'rafli',
          'email' => 'rafli@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //15
          'username' => 'khikmal',
          'email' => 'khikmal@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //16
          'username' => 'trio',
          'email' => 'trio@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //17
          'username' => 'dwi',
          'email' => 'dwi@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //18
          'username' => 'rifaul',
          'email' => 'rifaul@gmail.com',
          'role' => 'siswa',
          'password' => bcrypt('password'),
        ],
        [ //19
          'username' => 'hadiguru',
          'email' => 'hadiguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //20
          'username' => 'indahguru',
          'email' => 'indahguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //21
          'username' => 'slametguru',
          'email' => 'slametguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //22
          'username' => 'triguru',
          'email' => 'triguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //23
          'username' => 'ahmadguru',
          'email' => 'ahmadguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
        [ //24
          'username' => 'titinguru',
          'email' => 'titinguru@gmail.com',
          'role' => 'guru',
          'password' => bcrypt('password'),
        ],
      ])->each(function($user){
        User::create($user);
      });

      // collect([
      //     [ //1
      //       'username' => 'erikadmin',
      //       'email' => 'erikadmin@gmail.com',
      //       'role' => 'admin',
      //       'password' => bcrypt('password'),
      //     ],
      //     [ //2
      //       'username' => 'budiguru',
      //       'email' => 'budiguru@gmail.com',
      //       'role' => 'guru',
      //       'password' => bcrypt('password'),
      //     ],
      //     [ //3
      //       'username' => 'elfansiswa',
      //       'email' => 'elfansiswa@gmail.com',
      //       'role' => 'siswa',
      //       'password' => bcrypt('password'),
      //     ],
      // ])->each(function($user){
      //   User::create($user);
      // });
    }
}

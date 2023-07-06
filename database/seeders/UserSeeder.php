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
            'username' => 'mamanadmin',
            'email' => 'mamanadmin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
            'is_aktif' => true,
            'foto' => 'profile.jpg',
          ],
        ])->each(function($user){
          User::create($user);
        });
    }
}

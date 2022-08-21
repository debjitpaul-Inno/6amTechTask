<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Dummy User 1',
                'email' => 'dummy@gmail.com',
                'password' => bcrypt('password')
            ],
             [
                'name' => 'Dummy User 2',
                'email' => 'dummy2@gmail.com',
                'password' => bcrypt('password2')
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}

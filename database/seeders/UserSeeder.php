<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userdata = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Teknisi',
                'email' => 'teknisi@gmail.com',
                'role' => 'teknisi',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Klien',
                'email' => 'klien@gmail.com',
                'role' => 'klien',
                'password' => bcrypt('password'),
            ],
        ];

        foreach($userdata as $val){
             User::create($val);
        }

    }
}

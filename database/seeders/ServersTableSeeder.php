<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data servers
        $servers = [
            ['nama_server' => 'Bandar Lampung', 'latitude' => -5.3971, 'longitude' => 105.2668],
            ['nama_server' => 'Lampung Selatan', 'latitude' => -5.5623, 'longitude' => 105.5474],
            ['nama_server' => 'Lampung Tengah', 'latitude' => -4.8008, 'longitude' => 105.3131],
            // Tambahkan data server lainnya di sini sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel servers
        DB::table('servers')->insert($servers);
    }
}

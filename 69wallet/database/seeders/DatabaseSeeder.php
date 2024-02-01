<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Accounts;
use App\Models\Akun;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'foto_ktp' => 'default.jpg',
            'no_telp' => "089652744415", 
            'status' => 'verifikasi',
            'role_id' => 1

        ]);
        User::create([
            'name' => 'aralie',
            'email' => 'ara@gmail.com',
            'password' => bcrypt('123'),
            'foto_ktp' => 'default.jpg',
            'no_telp' => '089652744415',
            'status' => "verifikasi",
            'role_id' => 0

        ]);
        Akun::create([
            'user_id' => 2,
            'poin' => 10000,
            'saldo' => 50000.00,
            'pengeluaran' => 0
        ]);
    }
}

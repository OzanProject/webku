<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Standar Best Practice: Menggunakan updateOrCreate untuk mencegah duplikasi data 
        // apabila seeder dijalankan berulang kali (php artisan db:seed)
        User::updateOrCreate(
            ['email' => 'admin@ozanproject.com'], // Kriteria pencarian
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'), // Hash password secara aman
                'email_verified_at' => now(), // Tandai email sudah terverifikasi
                'is_admin' => true, // Berikan hak akses admin
            ]
        );
    }
}

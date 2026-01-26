<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'), 
            'nama' => 'Administrator Humas',
            'nrp' => '1234567890',
            'pangkat' => 'Kompol',
            'jabatan' => 'Kasubag Humas',
            'role' => 'Admin',
            'email' => 'admin@polresbangkalan.id',
            'telepon' => '081234567890',
            'status_aktif' => true,
        ]);

        // Petugas 1
        User::create([
            'username' => 'petugas1',
            'password' => Hash::make('petugas123'),
            'nama' => 'Bripka Ahmad Fayyez',
            'nrp' => '9876543210',
            'pangkat' => 'Bripka',
            'jabatan' => 'Staff Humas',
            'role' => 'Petugas',
            'email' => 'ahmad.fayyez@polresbangkalan.id',
            'telepon' => '081234567891',
            'status_aktif' => true,
        ]);

        // Petugas 2
        User::create([
            'username' => 'petugas2',
            'password' => Hash::make('petugas123'),
            'nama' => 'Briptu Cleo Patria',
            'nrp' => '1122334455',
            'pangkat' => 'Briptu',
            'jabatan' => 'Staff Humas',
            'role' => 'Petugas',
            'email' => 'cleo.patria@polresbangkalan.id',
            'telepon' => '081234567892',
            'status_aktif' => true,
        ]);
    }
}

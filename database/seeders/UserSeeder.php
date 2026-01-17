<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Guru Matematika',
            'email' => 'guru@sekolah.com',
            'password' => Hash::make('password'),
        ]);
    }
}

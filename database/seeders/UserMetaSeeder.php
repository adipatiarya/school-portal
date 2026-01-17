<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserMeta;

class UserMetaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user
        $users = User::all();

        foreach ($users as $user) {
            // Role
            UserMeta::create([
                'user_id'   => $user->id,
                'meta_key'  => 'role',
                'meta_value'=> $user->email === 'admin@sekolah.com' ? 'administrator' : 'teacher',
            ]);

            // Last login
            UserMeta::create([
                'user_id'   => $user->id,
                'meta_key'  => 'last_login',
                'meta_value'=> now()->subDays(rand(1,10))->toDateTimeString(),
            ]);

            // Preferred language
            UserMeta::create([
                'user_id'   => $user->id,
                'meta_key'  => 'language',
                'meta_value'=> 'id', // default bahasa Indonesia
            ]);
        }
    }
}

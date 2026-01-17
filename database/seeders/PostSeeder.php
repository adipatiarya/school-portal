<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email','admin@sekolah.com')->first();

        Post::create([
            'title' => 'Selamat Datang di Portal Sekolah',
            'content' => 'Ini adalah portal resmi sekolah untuk informasi akademik dan kegiatan.',
            'type' => 'post',
            'author_id' => $admin->id,
            'status' => 'publish',
        ]);

        Post::create([
            'title' => 'Pengumuman Ujian Semester',
            'content' => 'Ujian semester akan dilaksanakan mulai tanggal 10 Juni.',
            'type' => 'post',
            'author_id' => $admin->id,
            'status' => 'draft',

        ]);
    }
}

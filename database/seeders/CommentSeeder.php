<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $post = Post::first();
        $guru = User::where('email','guru@sekolah.com')->first();

        Comment::create([
            'post_id' => $post->id,
            'user_id' => $guru->id,
            'content' => 'Terima kasih atas informasinya!',
        ]);
    }
}
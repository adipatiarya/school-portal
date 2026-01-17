<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostMeta;

class PostMetaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua post
        $posts = Post::all();

        foreach ($posts as $post) {
            // Tambahkan metadata contoh
            PostMeta::create([
                'post_id'   => $post->id,
                'meta_key'  => 'featured_image',
                'meta_value'=> 'images/post-' . $post->id . '.jpg',
            ]);

            PostMeta::create([
                'post_id'   => $post->id,
                'meta_key'  => 'excerpt',
                'meta_value'=> substr($post->content, 0, 100) . '...',
            ]);

            PostMeta::create([
                'post_id'   => $post->id,
                'meta_key'  => 'views',
                'meta_value'=> rand(10, 100),
            ]);
        }
    }
}
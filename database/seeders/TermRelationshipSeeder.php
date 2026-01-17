<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Term;
use Illuminate\Support\Facades\DB;

class TermRelationshipSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua post dan terms
        $posts = Post::all();
        $terms = Term::all();

        // Hubungkan setiap post ke satu atau lebih terms
        foreach ($posts as $post) {
            // Ambil random terms untuk setiap post
            $randomTerms = $terms->random(rand(1, $terms->count()));

            foreach ($randomTerms as $term) {
                DB::table('term_relationships')->insert([
                    'post_id' => $post->id,
                    'term_id' => $term->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Taxonomy;
use App\Models\TermRelationship;
use Illuminate\Support\Facades\DB;

class TermRelationshipSeeder extends Seeder
{
    public function run(): void
    {

        // Hubungkan setiap post ke satu atau lebih terms
        TermRelationship::create([
                'taxonomy_id' => 1, //taxonomy_id
                'object_id' => 1 //post_id,
        ]);

        TermRelationship::create([
                'taxonomy_id' => 2, //taxonomy_id
                'object_id' => 2 , //post_id
        ]);

       
    }
}
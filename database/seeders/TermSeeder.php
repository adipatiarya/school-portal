<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;
use App\Models\Taxonomy;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        Term::create(['name' => 'Technology', 'slug' => 'technology']);
        Term::create(['name' => 'Education', 'slug' => 'education']);

        Taxonomy::create(['term_id' => 1, 'taxonomy' => 'category', 'description' => 'Tech related']);
        Taxonomy::create(['term_id' => 2, 'taxonomy' => 'category', 'description' => 'Education related']);


    }
}
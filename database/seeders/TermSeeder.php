<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori
        Term::create([
            'name' => 'Berita',
            'slug' => 'berita',
            'type' => 'category',
        ]);

        Term::create([
            'name' => 'Pengumuman',
            'slug' => 'pengumuman',
            'type' => 'category',
        ]);

        Term::create([
            'name' => 'Kegiatan',
            'slug' => 'kegiatan',
            'type' => 'category',
        ]);

        // Tag
        Term::create([
            'name' => 'Favorit',
            'slug' => 'favorit',
            'type' => 'tag',
        ]);

        Term::create([
            'name' => 'Urgent',
            'slug' => 'urgent',
            'type' => 'tag',
        ]);
    }
}
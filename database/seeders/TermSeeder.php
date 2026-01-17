<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        Term::create(['name' => 'Berita', 'slug' => 'berita']);
        Term::create(['name' => 'Pengumuman', 'slug' => 'pengumuman']);
        Term::create(['name' => 'Kegiatan', 'slug' => 'kegiatan']);
    }
}
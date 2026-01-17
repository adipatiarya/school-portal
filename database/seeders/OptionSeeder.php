<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        Option::create([
            'option_name' => 'site_name',
            'option_value' => 'Portal Sekolah SMP',
        ]);

        Option::create([
            'option_name' => 'site_url',
            'option_value' => 'http://localhost:8000',
        ]);
    }
}

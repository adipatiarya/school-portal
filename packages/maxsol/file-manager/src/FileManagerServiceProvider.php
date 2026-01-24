<?php

namespace Maxsol\FileManager;

use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
    }

    public function register()
    {
        // Registrasi binding atau helper
    }
}
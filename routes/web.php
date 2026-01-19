<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix(config('app.admin_dir'))
    ->group(function () {
        Route::get('', fn() => view('admin.index'))->name('admin.root');
        Route::get('{any}', fn() => view('admin.index'))
            ->where('any', '.*')
            ->name('admin.path');
    });




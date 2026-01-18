<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix(env('ADMIN_DIR')) ->group(
    function() {
        Route::controller(\App\Http\Controllers\Admin\DashboardController::class)->group(
            function () {
                Route::get('/dashboard', 'index')->name('admin.dashboard');
            }
        );


        //Posts
        Route::prefix('posts') ->group(
            function() {
                Route::controller(\App\Http\Controllers\Admin\PostController::class)->group(
                    function () {
                        Route::get('/', 'index')->name('admin.posts.index');
                        Route::get('/create', 'create')->name('admin.posts.create');
                        Route::post('/store', 'store')->name('admin.posts.store');
                        Route::get('/edit/{id}', 'edit')->name('admin.posts.edit');
                        Route::post('/update/{id}', 'update')->name('admin.posts.update');
                        Route::post('/delete', 'delete')->name('admin.posts.delete');
                    }
                );
            }
        );
    }
);




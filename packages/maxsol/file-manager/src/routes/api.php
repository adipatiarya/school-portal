<?php

use Illuminate\Support\Facades\Route;
use Maxsol\FileManager\Http\Controllers\FileManagerController;

Route::prefix('mx-filemanager')->group(function () {
    Route::get('/', [FileManagerController::class, 'index']);
    Route::post('/upload', [FileManagerController::class, 'upload']);
    Route::post('/create-dir', [FileManagerController::class, 'createDir']);
    Route::post('/move', [FileManagerController::class, 'move']);
    Route::delete('/file/{filename}', [FileManagerController::class, 'deleteFile']);
    Route::delete('/dir/{dirname}', [FileManagerController::class, 'deleteDir']);
});




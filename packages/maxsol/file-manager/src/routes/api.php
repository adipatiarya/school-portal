<?php

use Illuminate\Support\Facades\Route;
use Maxsol\FileManager\Http\Controllers\FileManagerController;

Route::prefix('api/mx-filemanager')->group(function () {
    Route::get('/', [FileManagerController::class, 'index']);
    Route::post('/upload', [FileManagerController::class, 'upload']);
    Route::post('/create-dir', [FileManagerController::class, 'createDir']);
    Route::post('/move', [FileManagerController::class, 'move']);
    Route::delete('/delete-file/{filename}', [FileManagerController::class, 'deleteFile']);
    Route::post('/delete-dir', [FileManagerController::class, 'deleteDir']);
});




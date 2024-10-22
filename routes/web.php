<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepoController;

Route::get('/', function () {
    return redirect(route('repo.form'));
});


Route::prefix('/repo')->group( function() {
    Route::get('/', [RepoController::class, 'form'])->name('repo.form');

    Route::prefix('/search')->group( function() {
        Route::post('/repositories', [RepoController::class, 'searchRepositories'])->name('repo.searchRepositories');

    });
});

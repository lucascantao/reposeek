<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepoController;

Route::get('/', function () {
    return redirect(route('repo.index'));
});


Route::prefix('/repo')->group( function() {
    Route::get('/', [RepoController::class, 'index'])->name('repo.index');
    Route::get('/show/{id}', [RepoController::class, 'show'])->name('repo.show');
    Route::get('/delete/{id}', [RepoController::class, 'delete'])->name('repo.delete');

    Route::prefix('/search')->group( function() {
        Route::post('/repositories', [RepoController::class, 'searchRepositories'])->name('repo.searchRepositories');

    });
});

require __DIR__.'/auth.php';
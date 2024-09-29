<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiRepoController;

Route::get('/repo/{path}', [ApiRepoController::class, 'getFileContent']);
Route::get('/repo/{keys}', [ApiRepoController::class, 'searchRepositories']);

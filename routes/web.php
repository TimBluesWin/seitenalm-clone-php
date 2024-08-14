<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RequestController::class, 'show']);
Route::post('/validate', [RequestController::class, 'validate']);

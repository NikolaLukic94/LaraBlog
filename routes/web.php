<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('threads','App\Http\Controllers\ThreadController');
Route::resource('threads','App\Http\Controllers\ReplyController');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

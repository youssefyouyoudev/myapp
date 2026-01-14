<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact');
Route::view('/api-tester', 'test.testclientpost');

// Marriage Game routes
Route::get('/game', function() { return view('game.home'); })->name('game.home');
Route::get('/game/categories', function() { return view('game.categories'); })->name('game.categories');
Route::get('/game/category', function() { return view('game.game'); })->name('game.category');
Route::get('/game/result', function() { return view('game.result'); })->name('game.result');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoController;

// Homepage
Route::get('/', [GoController::class, 'home'])->name('home');

// Authentication
Route::get('/login', [GoController::class, 'login']);
Route::get('/signup', [GoController::class, 'signup']);
Route::get('/logout', [GoController::class, 'logout']);

Route::post('/registraUtente', [GoController::class, 'registraUtente']);
Route::post('/controllaLogin', [GoController::class, 'controllaLogin']);

// Pages
Route::get('/faq', [GoController::class, 'faq'])->name('faq');
Route::get('/catalogo', [GoController::class, 'catalogo'])->name('catalogo');

// Orders
Route::get('/miei-ordini', [GoController::class, 'index'])->name('miei-ordini');

// Admin Area
Route::get('/admin/riservato', [GoController::class, 'dashboard'])->name('admin.riservato');

// Shopping Cart
Route::get('/carrello', [GoController::class, 'carrello'])->name('carrello');
Route::post('/carrello', [GoController::class, 'aggiungiAlCarrello']);
Route::get('/svuotaCarrello', [GoController::class, 'svuotaCarrello']);

Route::get('/dettaglio/{id}', [GoController::class, 'dettaglio']);

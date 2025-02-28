<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/index', [ContactController::class, 'index'])->name('contacts.index');

Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');
Route::post('/update', [ContactController::class, 'update'])->name('contacts.update');
Route::get('/delete/{id}', [ContactController::class, 'destroy'])->name('contacts.delete');
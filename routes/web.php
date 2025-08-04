<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductivityController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return view('test2');
});
Route::controller(ProductivityController::class)->group(function () {
    Route::get('/productivities', 'index')->name('productivity.index');
    Route::get('/productivities/create', 'create')->name('productivity.create');
    Route::post('/productivities', 'store')->name('productivity.store');
    Route::get('/productivities/{product}/edit', 'edit')->name('productivity.edit');
    Route::put('/productivities/{product}', 'update')->name('productivity.update');
    Route::delete('/productivities/{product}', 'destroy')->name('productivity.destroy');
    Route::get('/productivities/search', 'search')->name('search');
});

Route::controller(ReportController::class)->group(function () {
    Route::get('/report', 'index')->name('report.index');
    Route::get('/report/search', 'search')->name('search');
});
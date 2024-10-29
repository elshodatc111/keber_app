<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubstanceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SearchController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/user_create', [HomeController::class, 'user_create'])->name('user_create');
Route::post('/user_delete', [HomeController::class, 'user_delete'])->name('user_delete');


Route::get('/region', [RegionController::class, 'region'])->name('region');
Route::post('/region_create', [RegionController::class, 'region_create'])->name('region_create');
Route::post('/region_delete', [RegionController::class, 'region_delete'])->name('region_delete');

Route::get('/substance', [SubstanceController::class, 'substance'])->name('substance');
Route::post('/substance_create', [SubstanceController::class, 'substance_create'])->name('substance_create');
Route::post('/substance_delete', [SubstanceController::class, 'substance_delete'])->name('substance_delete');



Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/searchs/{id}', [SearchController::class, 'searchs'])->name('searchs');
Route::post('/search_create', [SearchController::class, 'search_create'])->name('search_create');
Route::post('/search_update_data', [SearchController::class, 'search_update_data'])->name('search_update_data');
Route::post('/search_update_photo', [SearchController::class, 'search_update_photo'])->name('search_update_photo');
Route::post('/search_delete', [SearchController::class, 'search_delete'])->name('search_delete');
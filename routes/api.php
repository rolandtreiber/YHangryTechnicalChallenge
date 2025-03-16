<?php

use App\Http\Controllers\CuisineController;
use App\Http\Controllers\SetMenuController;
use Illuminate\Support\Facades\Route;

Route::get('cuisines', [CuisineController::class, "index"])->name('cuisine.index');
Route::get('set-menus/{cuisineSlug?}', [SetMenuController::class, "index"])->name('get-set-menus-by-slug');

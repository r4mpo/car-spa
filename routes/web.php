<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });
Route::get('/car-shop/{any}', function () { return view('welcome'); })->where('any', '.*');
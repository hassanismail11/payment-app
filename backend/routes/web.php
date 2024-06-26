<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cards;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cards', [Cards::class,'index']);
Route::post('/cards', [Cards::class,'store']);
Route::get('/s1', [Cards::class,'s1']);
Route::get('/s2', [Cards::class,'s2']);
Route::get('/s3', [Cards::class,'s3']);
Route::get('/all', [Cards::class,'all']);

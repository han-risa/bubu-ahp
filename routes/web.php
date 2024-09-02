<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesainController;
use App\Http\Controllers\RankingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('desain', DesainController::class);

Route::get('/ranking-desain', [RankingController::class, 'rankingDesain'])->name('ranking.index');
Route::post('/ranking-desain-input', [RankingController::class, 'bulkAction'])->name('ranking.bulkAction');
Route::get('/ranking-hasil', [RankingController::class, 'hasil'])->name('ranking.hasil');
Route::post('/ranking-process', [RankingController::class, 'process'])->name('ranking.process');
Route::get('/ranking-entropy', [RankingController::class, 'entropy'])->name('ranking.entropy');
Route::get('/ranking-ahp', [RankingController::class, 'ahp'])->name('ranking.ahp');

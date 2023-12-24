<?php

use App\Http\Controllers\BuahController;
use App\Http\Controllers\DetailBuahController;
use Illuminate\Support\Facades\Route;

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
    return view('tanaman_pangan.index');
})->name('/');

Route::get('/get-buah', [BuahController::class, 'getBuah'])->name('get.buah');
Route::get('/detail-buah/{id}', [DetailBuahController::class, 'detailBuah'])->name('detail.buah');
// Route::get('/test-insert-buah', [BuahController::class, 'testQuery'])->name('test.query');

Route::get('/drilldown', function () {
    return view('tanaman_pangan.index');
})->name('drilldown');

<?php

use App\Http\Controllers\BuahController;
use App\Http\Controllers\DetailBuahController;
use App\Models\Buah;
use App\Models\DetailBuah;
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
    // return view('tanaman_pangan.index');
    return view('drilldown.index');
})->name('drilldown');

Route::get('/get-buah', [BuahController::class, 'getBuah'])->name('get.buah');
Route::get('/detail-buah/{id}', [DetailBuahController::class, 'detailBuah'])->name('detail.buah');
Route::get('/buah-pertahun', [DetailBuahController::class, 'getDrilldownByTahun'])->name('buah.pertahun');
Route::get('/buah/luas-lahan', [DetailBuahController::class, 'getDrilldownByLuasLahan'])->name('buah.luasLahan');
Route::get('/buah/produksi', [DetailBuahController::class, 'getDrilldownByProduksi'])->name('buah.produksi');
Route::get('/buah/produktivitas', [DetailBuahController::class, 'getDrilldownByProduktivitas'])->name('buah.produktivitas');

Route::get('/data-buah', function () {
    // return view('drilldown.index');
    return view('tanaman_pangan.index');
})->name('data.buah');

Route::get('/analysis', function () {
    $tahun = DetailBuah::distinct()->get(['tahun']);
    $buah = Buah::get(['id', 'nama_buah']);
    return view('analysis.index', ['tahun' => $tahun, 'buah' => $buah]);
})->name('analysis');

Route::get('/analys-buah/{idBuah}/{year}', [DetailBuahController::class, 'getAnalys'])->name('analys.buah');
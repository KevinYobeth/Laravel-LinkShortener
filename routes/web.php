<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [LinkController::class, 'index'])->name('dashboard');

    Route::get('/shorten', [LinkController::class, 'shorten'])->name('shortener');
    Route::post('/shorten', [LinkController::class, 'store'])->name('storeLink');

    Route::get('/edit/{slug}', [LinkController::class, 'edit'])->name('editLink');
    Route::post('/edit/{slug}', [LinkController::class, 'update'])->name('updateLink');
    Route::get('/show/{slug}', [LinkController::class, 'show'])->name('showLink');
    Route::get('/delete/{slug}', [LinkController::class, 'delete'])->name('deleteLink');

    Route::get('/status/{id}', [LinkController::class, 'revertStatus'])->name('revertStatus');

    Route::get('/download/{slug}', [LinkController::class, 'downloadQR'])->name('downloadQR');
});

Route::get('/link', [LinkController::class, 'index'])->name('link');
Route::post('/link', [LinkController::class, 'store'])->name('addLink');

Route::get('/{slug}', [LinkController::class, 'redirect']);

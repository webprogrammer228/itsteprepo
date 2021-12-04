<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoundController;
use App\Http\Controllers\ClaimController;
use App\Models\Sound;

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

Route::get('/download', [SoundController::class, 'download']);
Route::post('/download', [SoundController::class, 'store']);
Route::get('/', [SoundController::class, 'index']);
Route::post('/', [SoundController::class, 'index']);
Route::get('/songs', [SoundController::class, 'songs']);
Route::get('/claims', [ClaimController::class, 'index']);
Route::post('/claims', [ClaimController::class, 'store']);
Route::get('/users', [SoundController::class, 'getUsers']);

Route::post('/users/{id}', [SoundController::class, 'block'])->name('users.block');

Route::delete('/claims/{id}', [ClaimController::class, 'destroy'])
    ->name('claims.destroy');


//Route::group(['middleware' => ['role:admin']], function () {
//    Route::get('/claims', [SoundController::class, 'claim']);
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

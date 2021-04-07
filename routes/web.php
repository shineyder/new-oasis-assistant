<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TerritoryController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'handleLogin']);

Route::middleware(['auth:sanctum', 'verified'])->get('/user/profile', function () {
    return view('profile.show');
})->name('profile');

Auth::routes();

Route::get('/FAQ', function () {
    return view('FAQ');
})->name('FAQ')->middleware('auth');

Route::get('/contact-us', [ContactUsController::class, 'index'])->middleware('auth')->name('contactus.index');
Route::post('/contact-us', [ContactUsController::class, 'sendContact'])->name('contactus.send');

Route::get('/territory', [TerritoryController::class, 'index'])->middleware('auth')->name('territory.index');
Route::get('/territory/{regio}', [TerritoryController::class, 'showRegio'])->middleware('auth')->name('territory.regio');
Route::get('/territory/{regio}/{local}', [TerritoryController::class, 'showLocal'])->middleware('auth')->name('territory.local');

Route::get('/frame/{local}', [TerritoryController::class, 'showFrame'])->middleware('auth')->name('territory.show');
Route::post('/frame', [TerritoryController::class, 'report'])->name('territory.report');

Route::get('/master-publisher', [PublisherController::class, 'index'])->name('publisher.index');

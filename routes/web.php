<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReportController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/FAQ', function () {
        return view('FAQ');
    })->name('FAQ');

    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contactus.index');
    Route::post('/contact-us', [ContactUsController::class, 'sendContact'])->name('contactus.send');

    Route::get('/territory', [TerritoryController::class, 'index'])->name('territory.index');
    Route::get('/territory/{regio}', [TerritoryController::class, 'showRegio'])->name('territory.regio');
    Route::get('/territory/{regio}/{local}', [TerritoryController::class, 'showLocal'])->name('territory.local');

    Route::get('/frame/{local}', [TerritoryController::class, 'showFrame'])->name('territory.show');
    Route::post('/frame', [TerritoryController::class, 'report'])->name('territory.report');

    Route::get('/master-publisher', [PublisherController::class, 'index'])->name('publisher.index');
    Route::get('/master-publisher-data', [PublisherController::class, 'data'])->name('publisher.data');
    Route::post('/master-publisher-group', [PublisherController::class, 'updateGroup'])->name('publisher.group');
    Route::post('/master-publisher-access', [PublisherController::class, 'updateAccess'])->name('publisher.access');

    Route::get('/master-contact-us', [ContactUsController::class, 'masterIndex'])->name('contactusmaster.index');
    Route::get('/master-contact-us-data', [ContactUsController::class, 'masterData'])->name('contactusmaster.data');
    Route::post('/master-contact-us-status', [ContactUsController::class, 'masterUpdateStatus'])->name('contactusmaster.status');

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report-data', [ReportController::class, 'data'])->name('report.data');

    Route::get('/master-report', [ReportController::class, 'masterIndex'])->name('reportmaster.index');
    Route::get('/master-report-data', [ReportController::class, 'masterData'])->name('reportmaster.data');
    Route::get('/master-report-s13', [ReportController::class, 'doS13'])->name('territory.s13');

    Route::post('/report-update', [ReportController::class, 'updateReport'])->name('report.update');
    Route::post('/report-delete', [ReportController::class, 'deleteReport'])->name('report.delete');
});

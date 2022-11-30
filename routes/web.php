<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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


Route::get('/', [MainController::class, 'indexPage'])->name('home-page');

Route::get('/risky-place', [MainController::class, 'riskyPlace'])->name('risky-place-page');

Route::post('', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/manager/reports', [MainController::class, 'manageReports'])->name('manage-reports');
Route::get('/manager/places', [MainController::class, 'managePlaces'])->name('manage-places');

Route::post('/manager/places', [MainController::class, 'addRiskyPlace'])->name('add-risky-place');
Route::get('/manager/place/{place_id}', [MainController::class, 'placeUpdateForm'])->name('place-update-form');
Route::post('/manager/place/{place_id}/update', [MainController::class, 'updateRiskyPlace'])->name('update-place');
Route::get('/manage/place/{place_id}/delete', [MainController::class, 'deleteRiskyPlace'])->name('delete-place');

Route::post('/manager/report/add', [MainController::class, 'addReport'])->name('add-report');
Route::get('/manager/report/{report_date}', [MainController::class, 'reportUpdateForm'])->name('report-update-form');
Route::post('/manager/report/{report_date}', [MainController::class, 'updateReport'])->name('update-report');
Route::get('/manager/report/{report_date}/delete', [MainController::class, 'deleteReport'])->name('delete-report');
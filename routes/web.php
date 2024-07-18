<?php

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
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PMController;
use App\Http\Controllers\ProjectController;
            

	Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	// auth
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
	// end auth

Route::group(['middleware' => 'auth'], function () {
	Route::get('/officer/{id}', [PMController::class, 'officer'])->name('page');
	Route::post('/rekap/{officer_id}/{tahun}/{bulan}', [PMController::class, 'rekap']);
	Route::post('/rekap/{officer_id}/all', [PMController::class, 'rekapAll']);

	Route::get('/setting/password', [UserController::class, 'changePassword']);
	Route::post('/setting/password/save', [UserController::class, 'changePassword_post']);
	
	Route::post('/reporting/saveRencanaMingguan/{id_weekly}', [UserController::class, 'saveRencanaMingguan']);
	Route::post('/reporting/saveRencanaHarian/{id_weekly}', [UserController::class, 'saveRencanaHarian']);
	Route::post('/reporting/saveRealisasiMingguan/{id_weekly}/{oid}', [UserController::class, 'saveRealisasiMingguan']);
	Route::post('/reporting/saveRealisasiMingguan/komentar/{id_weekly}/{oid}', [UserController::class, 'saveRealisasiMingguanKomentar']);
	
	Route::get('/reporting/output/{id_weekly}/{oid}', [UserController::class, 'realisasiMingguan']);
	Route::get('/reporting/logbook/{id_weekly}/{oid}', [UserController::class, 'logBookHarian']);
	
	Route::get('/projects', [ProjectController::class, 'index']);
	Route::get('/projects/edit/{id}', [ProjectController::class, 'editProject']);
	Route::get('/projects/monitoring/{id}', [ProjectController::class, 'monitoringProject']);
	Route::get('/getter/activities/{id}', [ProjectController::class, 'fetchActivities']);
	Route::get('/getter/event/{id}', [ProjectController::class, 'fetchEvent']);
	Route::post('/projects/activities/save/{id}', [ProjectController::class, 'saveActivities']);
	Route::post('/projects/saveEditProject/{id}', [ProjectController::class, 'saveEditProject']);
	Route::post('/projects/saveProject', [ProjectController::class, 'saveProject']);

	Route::get('/getter/project/{id}', [ProjectController::class, 'getterProject']);
	Route::get('/getter/rencanaHarian/{id}', [UserController::class, 'getterRencanaHarian']);

	Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
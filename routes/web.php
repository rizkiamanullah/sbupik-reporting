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
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;         
use App\Http\Controllers\KanbanController;   
use App\Http\Controllers\newsController;   
use App\Http\Controllers\ProjectController;   
use App\Http\Controllers\PMController;   
            

	Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	// auth
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
	// end auth
	
	// // kanban
	// Route::get('/getTask/{user_id}',[KanbanController::class,'getTask']);
	// Route::get('/getTaskDetail/{user_id}',[KanbanController::class,'getTaskDetail']);
	// Route::get('/getKomentarTask',[KanbanController::class,'getKomentarTask']);
	// Route::post('/saveTask/{user_id}',[KanbanController::class,'saveTask']);
	// Route::post('/switchTask/{user_id}',[KanbanController::class,'switchTask']);
	// Route::post('/archiveTask',[KanbanController::class,'archiveTask']);
	// Route::post('/saveKomentarTask',[KanbanController::class,'saveKomentarTask']);
	// // end kanban
	
	// // sticky notes
	// Route::get('/getStickyNotes',[UserController::class,'getStickyNotes']);
	// Route::post('/saveStickyNotes',[UserController::class,'saveStickyNotes']);
	// Route::post('/deleteStickyNotes',[UserController::class,'deleteStickyNotes']);
	// // end sticky notes

	// // messaging
	// Route::get('/fetchMessages',[UserController::class,'fetchMessages']);
	// Route::post('/messaging',[UserController::class,'messaging']);
	// // end messaging
	
	// // news
	// Route::get('/fetchNews',[newsController::class,'fetchNews']);
	// Route::post('/storeNews',[newsController::class,'storeNews']);
	// Route::post('/archiveNews',[newsController::class,'archiveNews']);
	// // end news
	
	// crud row dynamic data
	Route::get('/getAllRowData',[PageController::class,'getAllRowData']);
	Route::post('/saveRowData',[PageController::class,'saveRowData']);
	Route::post('/updateRowData',[PageController::class,'updateRowData']);
	Route::post('/deleteRowData',[PageController::class,'deleteRowData']);
	// end crud row dynamic data
	
	// projects
	Route::post('/project/saveProject',[ProjectController::class, 'save']);
	Route::post('/project/saveDeliverable',[ProjectController::class, 'saveDeliverable']);
	Route::get('/project/fetchDeliverable',[ProjectController::class, 'fetchDeliverable']);
	Route::post('/saveRowData',[PageController::class,'saveRowData']);
	Route::post('/updateRowData',[PageController::class,'updateRowData']);
	Route::post('/deleteRowData',[PageController::class,'deleteRowData']);
	// end projects
	
Route::group(['middleware' => 'auth'], function () {
	Route::get('/project/{id}/tasks',[ProjectController::class, 'show'])->name('tasks');
	
	// reporting	
	Route::post('/reporting/save', [UserController::class, 'saveReporting']);
	Route::post('/reporting/weekly/save', [UserController::class, 'saveReportingWeekly']);
	Route::get('/pm-report/user/{id}', [UserController::class,'getReports']);
	Route::post('/pm-report/reportok', [UserController::class,'reportOk']);
	// end reporting

	// kanban
	Route::get('/kanban', [UserController::class, 'show'])->name('kanban');
	Route::get('/kanban/archives', [UserController::class, 'showArchives'])->name('kanban');
	// end kanban

	Route::get('/officer/{id}', [PMController::class, 'officer'])->name('page');


	Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
// Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
// Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
// Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
// Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
// Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
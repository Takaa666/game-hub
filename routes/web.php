<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LuckyWheelController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\RegisterAdminContorller;
use App\Http\Controllers\RegisterController as ControllersRegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Developer;
use App\Models\LuckyWheel;
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
Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/register-admin', function () {
    return view('register-admin');
});


Route::group(['prefix' => 'cart'], function() {
    Route::get('/', [CartController::class, 'index'])->name('cart');
});

Route::group(['prefix' => 'news'], function() {
    Route::get('/', [NewsController::class, 'index'])->name('news');
});

Route::group(['prefix' => 'master-game'], function() {
    Route::get('/' , [GameController::class, 'index'])->name('master-game');
    Route::get('/create' , [GameController::class, 'create'])->name('create-game');
    Route::post('/store' , [GameController::class, 'store'])->name('store-game');
    Route::get('/edit/{id_game?}' , [GameController::class, 'edit'])->name('edit-master');
    Route::post('/update/{id_game?}', [GameController::class, 'update'])->name('update-game');
    Route::get('/delete/{id_game?}', [GameController::class, 'delete'])->name('dellete-game');
   
});



Route::group(['prefix' => 'developer' ], function() {
    Route::get('/', [DeveloperController::class, 'index'])->name('developer');
    Route::get('/data' , [DeveloperController::class,'get'])->name('get-developer');
    Route::get('/create' , [DeveloperController::class, 'create'])->name('create-developer');
    Route::post('/store', [DeveloperController::class, 'store'])->name('store-developer');
    Route::post('/update/{id_developer?}', [DeveloperController::class, 'update'])->name('update-developer');
    Route::get('/edit/{id_developer?}', [DeveloperController::class, 'edit'])->name('edit-developer');
    Route::get('/view/{id_developer?}', [DeveloperController::class, 'view'])->name('view-developer');
    Route::get('/delete/{id_developer?}', [DeveloperController::class, 'delete'])->name('dellete-developer');
});

Route::group(['prefix' => 'platform' ], function() {
    Route::get('/', [PlatformController::class, 'index'])->name('platform');
    Route::get('/data' , [PlatformController::class,'get'])->name('get-platform');
    Route::get('/create' , [PlatformController::class, 'create'])->name('create-platform');
    Route::post('/store', [PlatformController::class, 'store'])->name('store-platform');
    Route::post('/update/{id_platform?}', [PlatformController::class, 'update'])->name('update-platform');
    Route::get('/edit/{id_platform?}', [PlatformController::class, 'edit'])->name('edit-platform');
    Route::get('/view/{id_platform?}', [PlatformController::class, 'view'])->name('view-platform');
    Route::get('/delete/{id_platform?}', [PlatformController::class, 'delete'])->name('dellete-platform');
});

Route::group(['prefix' => 'genre' ], function() {
    Route::get('/', [GenreController::class, 'index'])->name('genre');
    Route::get('/data' , [GenreController::class,'get'])->name('get-genre');
    Route::get('/create' , [GenreController::class, 'create'])->name('create-genre');
    Route::post('/store', [GenreController::class, 'store'])->name('store-genre');
    Route::post('/update/{id_genre?}', [GenreController::class, 'update'])->name('update-genre');
    Route::get('/edit/{id_genre?}', [GenreController::class, 'edit'])->name('edit-genre');
    Route::get('/view/{id_genre?}', [GenreController::class, 'view'])->name('view-genre');
    Route::get('/delete/{id_genre?}', [GenreController::class, 'delete'])->name('dellete-genre');
});

Route::group(['prefix' => 'login'], function() { 
    Route::post('/auth',[LoginController::class,'authenticate'])->name('auth-login');
    Route::get('/',[LoginController::class,'index'])->name('login');
    
});

Route::group(['prefix' => 'register'], function() { 
    Route::post('/store', [ControllersRegisterController::class, 'store'])->name('store-register');
});
Route::group(['prefix' => 'register-admin'], function() { 
    Route::post('/store', [RegisterAdminContorller::class, 'store'])->name('store-register-admin');
});

Route::group(['middleware' => 'auth'], function() { 
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
    Route::post('/komentar', [KomentarController::class, 'store'])->name('store-komentar');
    
Route::group(['prefix' => 'store'], function() {
    Route::get('/', [StoreController::class, 'index'])->name('store')->middleware('auth');
    Route::get('/detail/{id_game}', [DetailController::class, 'detail'])->name('detail-game');
    Route::delete('/detail/{id_komentar?}', [DetailController::class, 'destroy'])->name('delete-komentar');


});
});


Route::get('/search', [SearchController::class,'search']);



Route::group(['prefix' => 'display'], function() { 
    Route::get('/', [DisplayController::class, 'index'])->name('display'); 
    Route::post('/store' , [DisplayController::class ,'store'])->name('store-display');
    Route::get('/delete/{id_display?}' , [DisplayController::class ,'delete'])->name('dellete-display'); 
    Route::get('/data' , [DisplayController::class,'get'])->name('get-display');
    Route::get('/create', [DisplayController::class, 'create'])->name('create-display');
    Route::get('/view/{id_display?}', [DisplayController::class, 'view'])->name('view-display');
    Route::post('/update/{id_display?}', [DisplayController::class, 'update'])->name('update-display');
    Route::get('/edit/{id_display?}', [DisplayController::class, 'edit'])->name('edit-display');
});

Route::group(['prefix' => 'user' ], function() {
    Route::get('/', [UserController::class, 'index'])->name('user');
    Route::get('/data' , [UserController::class,'get'])->name('get-user');
    Route::get('/create' , [UserController::class, 'create'])->name('create-user');
    Route::post('/store', [UserController::class, 'store'])->name('store-user');
    Route::post('/update/{id?}', [UserController::class, 'update'])->name('update-user');
    Route::get('/edit/{id?}', [UserController::class, 'edit'])->name('edit-user');
    Route::get('/view/{id?}', [UserController::class, 'view'])->name('view-user');
    Route::get('/delete/{id?}', [UserController::class, 'delete'])->name('dellete-user');
});

Route::group(['prefix' => 'lucky-wheel' ], function() {
    Route::get('/', [LuckyWheelController::class, 'index'])->name('lucky-wheel');
    Route::post('/spin', [LuckyWheelController::class, 'spin'])->name('lucky-wheel-spin');
});

Route::group(['prefix' => 'transaksi'], function() {
    Route::get('/' , [TransaksiController::class , 'index'])->name('transaksi');
    Route::get('/data' , [TransaksiController::class,'get'])->name('get-transaksi');
    Route::get('/create/{id_game?}' , [TransaksiController::class, 'create'])->name('create-transaksi');
    Route::post('/store', [TransaksiController::class, 'store'])->name('store-transaksi');
    Route::post('/update/{id_transaksi?}', [TransaksiController::class, 'update'])->name('update-transaksi');
    Route::get('/edit/{id_transaksi?}', [TransaksiController::class, 'edit'])->name('edit-transaksi');
    Route::get('/view/{id_transaksi?}', [TransaksiController::class, 'view'])->name('view-transaksi');
    Route::get('/delete/{id_transaksi?}', [TransaksiController::class, 'delete'])->name('dellete-transaksi');
});


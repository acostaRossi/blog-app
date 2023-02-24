<?php

use Illuminate\Support\Facades\Route;
use App\Models\News;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;

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
    return view('welcome');
})->name('home');

/******************************************************************************/
/**************** NEWS ********************************************************/
/******************************************************************************/

Route::get('news', [NewsController::class, 'index'])->name('news');

Route::get('news/{id}', [NewsController::class, 'getNews'])->name('news-detail')/*->middleware(['auth-blog'])*/;

Route::get('news/category/{category}', [NewsController::class, 'getNewsByCategory'])->name('news-category');

/******************************************************************************/
/**************** COMMENTS ****************************************************/
/******************************************************************************/

Route::post('news/{id}/comment', [NewsController::class, 'doComment'])->name('auth.do-comment');

/******************************************************************************/
/**************** AUTH ********************************************************/
/******************************************************************************/

Route::get('login', [AuthController::class, 'login'])->name('auth.login');

Route::post('login', [AuthController::class, 'doLogin'])->name('auth.do-login');

Route::get('register', [AuthController::class, 'register'])->name('auth.register');

Route::post('register', [AuthController::class, 'doRegister'])->name('auth.do-register');

Route::get('logout', [AuthController::class, 'doLogout'])->name('auth.logout');

Route::get('register-success', [AuthController::class, 'registrationSuccess'])->name('auth.register-success');

Route::get('register-error', [AuthController::class, 'registrationError'])->name('auth.register-error');

Route::get('confirm-registration/{id}/{token}', [AuthController::class, 'registrationConfirm'])->name('auth.register-confirm');


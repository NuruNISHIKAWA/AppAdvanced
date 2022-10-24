<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

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
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/
require __DIR__.'/auth.php';

Route::get('/', [ListController::class, 'index']);
Route::post('/add', [ListController::class, 'create']);
Route::post('/edit', [ListController::class, 'update']);
Route::post('/delete', [ListController::class, 'remove']);
Route::post('/change', [ListController::class, 'change']);

Route::get('/find', [ListController::class, 'find']);
Route::post('/search', [ListController::class, 'search']);

Route::get('/session', [SessionController::class, 'getSes']);
Route::post('/session', [SessionController::class, 'postSes']);


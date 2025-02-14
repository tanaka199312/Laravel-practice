<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostController;

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
//Route::get('/index', [PostsController::class, 'index']);
//Route::get('/show', [PostsController::class, 'show']);
Route::get('/index', [PostController::class, 'index'])->name('index');
Route::get('/create', [PostController::class, 'showCreate'])->name('show.create');
Route::post('/create', [PostController::class, 'storePost'])->name('store.post');
Route::get('/edit/{id}', [PostController::class, 'showEdit'])->name('show.edit');
Route::post('/edit/{id}', [PostController::class, 'registEdit'])->name('regist.edit');
Route::delete('/delete/{id}', [PostController::class, 'deletePost'])->name('delete');

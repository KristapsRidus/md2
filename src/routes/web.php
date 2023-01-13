<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\ZanrsController;
use App\Http\Controllers\DataController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/authors', [AuthorController::class, 'list']);
Route::get('/authors/create', [AuthorController::class, 'create']);
Route::post('/authors/put', [AuthorController::class, 'put']);
Route::post('/authors/delete/{author}', [AuthorController::class, 'delete']);
Route::get('/authors/update/{author}', [AuthorController::class, 'update']);
Route::post('/authors/patch/{author}', [AuthorController::class, 'patch']);

Route::get('/albums', [AlbumController::class, 'list']);
Route::get('/albums/create', [AlbumController::class, 'create']);
Route::post('/albums/put', [AlbumController::class, 'put']);
Route::get('/albums/update/{album}', [AlbumController::class, 'update']);
Route::post('/albums/patch/{album}', [AlbumController::class, 'patch']);
Route::post('/albums/delete/{album}', [AlbumController::class, 'delete']);

Route::get('/login', [AuthorizationController::class, 'login'])->name('login');
Route::post('/auth', [AuthorizationController::class, 'authenticate']);
Route::get('/logout', [AuthorizationController::class, 'logout']);

Route::get('/zanri', [ZanrsController::class, 'list']);
Route::get('/zanri/create', [ZanrsController::class, 'create']);
Route::post('/zanri/put', [ZanrsController::class, 'put']);
Route::get('/zanri/update/{zanrs}', [ZanrsController::class, 'update']);
Route::post('/zanri/patch/{zanrs}', [ZanrsController::class, 'patch']);
Route::post('/zanri/delete/{zanrs}', [ZanrsController::class, 'delete']);

// Data routes
Route::prefix('data')->group(function () {
	Route::get('/get-top-albums', [DataController::class, 'getTopAlbums']);
	Route::get('/get-album/{album}', [DataController::class, 'getAlbum']);
	Route::get('/get-related-albums/{album}', [DataController::class, 'getRelatedAlbums']);
});

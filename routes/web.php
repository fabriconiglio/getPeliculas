<?php

use App\Http\Controllers\MovieController;
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
    return view('movies.index', ['movies' => \App\Models\Movie::all()]);
});
//OBTENER PELICULAS DE LA API
Route::get('/fetch-movies', [MovieController::class, 'fetchAndStoreMovies']);

//CRUD DE PELICULAS
Route::resource('movies', MovieController::class);




<?php

use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\TweetController;
use App\Models\comentarios;
use App\Models\publicacoes;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('index');
})->name('dashboard');




Route::middleware(['auth'])->group(function(){



    Route::get('/index',[TweetController::class, 'index'])->name('index');
    Route::get('/index/mundo',[TweetController::class, 'mundo'])->name('mundo');

    
    Route::post('/index/mundo',[TweetController::class, 'storeSeguir'])->name('create.seguir');
    Route::post('/index', [TweetController::class, 'store'])->name('posts.create');
    Route::post('/comentario',[ComentariosController::class, 'store'])->name('comentario.create');




});


<?php

use App\Http\Controllers\HasilMatrixController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/kriteria', [HomeController::class,'kriteria'])->name('Home.kriteria');
Route::get('/detail', [HomeController::class,'detail'])->name('Home.detail');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/Kriteria.php';
require __DIR__.'/Alternatif.php';

Route::group(['prefix'=> 'Perhitungan', 'as'=> 'Perhitungan.', 'middleware'=> ['auth', 'role:admin']],function(){
    Route::controller(HasilMatrixController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('generateKriteria', 'generateKriteriaMatrix')->name('generateKriteriaMatrix');

    });
});

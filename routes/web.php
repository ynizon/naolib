<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
    return redirect("/dashboard");
});

Route::get('dashboard', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');
Route::get('dashboard/{lat}/{lng}', 'App\Http\Controllers\HomeController@dashboard');
Route::get('perturbations', 'App\Http\Controllers\HomeController@perturbations');
Route::get('refreshArret/{codeLieu}', 'App\Http\Controllers\HomeController@refreshArret');
Route::get('detailArret/{ligneBus}/{codeLieu}/{sens}/{date}', 'App\Http\Controllers\HomeController@detailArret');
Route::get('refreshFavorisArret/{codeLieu}/{ligneBus}', 'App\Http\Controllers\HomeController@refreshFavorisArret');
Route::get('listArrets', 'App\Http\Controllers\HomeController@listArrets');
Route::post('goto', 'App\Http\Controllers\HomeController@goto');
Route::get('infos', 'App\Http\Controllers\HomeController@infos');
Route::get('addFavorite/{codeLieu}/{bus}', 'App\Http\Controllers\HomeController@addFavorite');

/*
Route::get('/temps/{id}', 'Controller@temps')->name('temps');
Route::get('/cron', 'Controller@cron')->name('cron');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/remove', 'HomeController@remove')->name('remove');
Route::post('/home', 'HomeController@index');
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

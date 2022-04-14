<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DeploymentController;

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
    // return request()->server();
    return view('welcome');
});

Auth::routes([ 'register' => false ]);

Route::middleware('auth')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('servers', ServerController::class);

    Route::prefix('projects')->name('projects.')->group(function(){
        Route::resource('/', ProjectController::class)->parameter('', 'project');

        Route::prefix('{project}')->group(function(){
            Route::get('deployments', DeploymentController::class)->name('deployments');

            Route::prefix('update')->name('update.')->group(function(){
                Route::put('server', [ProjectController::class, 'updateServer'])->name('server');
                Route::put('repository', [ProjectController::class, 'updateRepository'])->name('repository');
            });
        });
    });

});

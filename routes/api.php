<?php

use App\Http\Controllers\Api\ExportDbController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Task Groups Endpoint
Route::controller(TaskGroupController::class)->prefix('tasks-groups')->group(function(){
    Route::get('/', 'index')->name('tasks.index');
    Route::post('/store', 'store')->name('tasks.store');
    Route::patch('/{id}/update', 'update')->name('tasks.update');
    Route::delete('/{id}', 'destroy')->name('tasks.delete');
});

// Tasks Endpoints
Route::controller(TaskController::class)->prefix('tasks')->group(function(){
    Route::get('/', 'index')->name('tasks.index');
    Route::post('/store', 'store')->name('tasks.store');
    Route::patch('/{id}/update', 'update')->name('tasks.update');
    Route::delete('/{id}', 'destroy')->name('tasks.delete');
});

Route::controller(ExportDbController::class)->prefix('export-db')->group(function(){
    Route::get('/', 'export')->name('db.export');
});

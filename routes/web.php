<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::get('/', [TaskController::class, 'index'])->name('home');

Route::group(['prefix' => 'task'], function(){
    Route::post('sortable', [TaskController::class, 'sortable'])->name('task.sortable');

    Route::get('add', [TaskController::class, 'addView'])->name('task.add');
    Route::post('addPost', [TaskController::class, 'addPost'])->name('task.addPost');

    Route::get('edit/{id}', [TaskController::class, 'editView'])->name('task.edit');
    Route::post('editPost/{id}', [TaskController::class, 'editPost'])->name('task.editPost');

    Route::delete('delete', [TaskController::class, 'delete'])->name('task.delete');
});
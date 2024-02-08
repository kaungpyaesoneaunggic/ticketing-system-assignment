<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', UserController::class);
Route::resource('category',CategoryController::class);
Route::resource('label',LabelController::class);
Route::get('/ticket/{id}/comment', [CommentController::class, 'index'])->name('comment.index');
Route::post('/ticket/{id}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/ticket/{id}/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::resource('ticket',TicketController::class);

// Route::get('/create', [DrinkController::class, 'create'])->name('drink.create');
// Route::post('/', [DrinkController::class, 'store'])->name('drink.store');
// Route::get('/{drink}/edit', [DrinkController::class, 'edit'])->name('drink.edit');
// Route::put('/{drink}', [DrinkController::class, 'update'])->name('drink.update');
// Route::get('/{drink}', [DrinkController::class, 'show'])->name('drink.show');
// Route::delete('/', [DrinkController::class, 'destroy'])->name('drink.destroy');
// });
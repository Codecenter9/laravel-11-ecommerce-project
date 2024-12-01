<?php

use App\Http\Controllers\answerController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\questionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function ()
{
Route::get('/home',[homeController::class,'home'])->name('main.home');
Route::get('/result',[answerController::class,'index'])->name('result.index');
Route::post('/result',[answerController::class,'store'])->name('result.store');

});

Route::middleware('auth')->group(function () {
    Route::get('/questions', [questionController::class, 'index'])->name('question.index');

});

Route::middleware(['auth','admin'])->group(function(){
    Route::post('/storequestions', [questionController::class, 'store'])->name('question.store');
    Route::get('/create', [questionController::class, 'create'])->name('question.create');
    Route::get('/editquestions/{questions}', [questionController::class, 'edit'])->name('question.edit');
    Route::patch('/questions/{questions}', [questionController::class, 'update'])->name('question.update');
    Route::delete('/questions/{questions}', [questionController::class, 'destroy'])->name('question.destroy');
    Route::get('/questions/{questions}', [questionController::class, 'delete'])->name('question.delete');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

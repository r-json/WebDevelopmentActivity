<?php

use App\Http\Controllers\CalculateController;
use App\Http\Controllers\FallBackController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home/{id}/{name}', [HomeController::class, 'Home'])->name('AboutMe');

Route::get('/AboutMe/{id}/{name}', [HomeController::class, 'AboutMe'])->name('about');
Route::get('/contact/{id}/{name}', [HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'user'], function () {

    //     Route::get('/', function(){
    //     return ("User Page");
    // });
    //     Route::get('/edit/{id}', function($id){
    //     return("User Edit Page" .$id );
    // });
    //     Route::get('/add', function(){
    //     return ('User Add Page');
    // });
    //     Route::get('/delete/{id}', function($id){
    //     return ('User Delete Page');
    // });

    Route::get('/', [UserController::class, 'UserPage']);
    Route::post('/', [UserController::class, 'userSubmit'])->name('user.submit');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/add', [UserController::class, 'UserAddPage']);
    Route::get('/delete/{id}', [UserController::class, 'UserDeletePage']);
});

Route::get('compute/{num1}/{num2}', [CalculateController::class, 'index']);
Route::get('page', [PageController::class, 'index']);
Route::get('form', [FormController::class, 'index']);

Route::get('/post', [PostController::class, 'index']);
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');

Route::get('/notfound', [FallBackController::class, 'notfound'])->name('NotFound');
Route::fallback([FallBackController::class, 'fallback']);

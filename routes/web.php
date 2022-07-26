<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsController;

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
    // User::where('name','ihsan')->get()->dd();
    return view('welcome');
})->name('home');

Route::get('/endpoint', function () {

    return to_route('home');

    // return redirect()->route('home');

    // both are functionally identicall
    
});



Route::controller(PostsController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::get('/posts/{post}', 'show');
    Route::post('/posts', 'store');
});

Route::controller(BlogController::class)->group(function () {
    Route::get('blog', 'index');
    Route::get('blog/{blog}', 'show');
    Route::post('blog/store', 'store');
});

Route::controller(NewsController::class)->group(function () {
    Route::get('news', 'index');
    Route::get('news/{news}', 'show');
    Route::post('news/store', 'store');
});



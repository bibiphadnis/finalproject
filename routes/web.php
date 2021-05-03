<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CuisineController;
use App\Models\Cuisine;
use App\Models\Recipe;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;


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



if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
};


Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/new', [RecipeController::class, 'create'])->name('recipes.create');
Route::get('/recipes/{id}', [RecipeController::class, 'details'])->name('recipes.details');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::get('/recipes/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::post('/recipes/{id}/updated', [RecipeController::class, 'update'])->name('recipes.update');
Route::post('/recipes/{id}', [RecipeController::class, 'delete'])->name('recipes.delete');

Route::get('/cuisines', [CuisineController::class, 'index'])->name('cuisines.index');
Route::get('cuisines/{id}', [CuisineController::class, 'show'])->name('cuisines.show');

Route::get('/register', [RegistrationController::class,'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class,'register'])->name('registration.register');
Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginform');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/about', function() {
    return view('about');
});
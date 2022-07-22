<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
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

Route::controller(BookController::class)->group(function() {
    // Guest
    Route::get('/books', 'index');
    // Auth
    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/books', 'store');
        Route::get('/books/{id}', 'show');
        Route::put('/books/{id}', 'update');
        Route::delete('/books/{id}', 'destroy');
        Route::get('/books/find/{name}', 'find');
    });
});

Route::controller(CategoryController::class)->group(function() {
    Route::get("/category", 'index');
    Route::post("/category", 'store');
    Route::get("/category/{id}", 'show');
    Route::put("/category/{id}", 'update');
    Route::delete("/category/{id}", 'destroy');
    Route::get("/category/find/{name}", 'find');
});

// Guest
Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/users', 'all');
});
// Auth
Route::middleware('auth:sanctum')->controller(AuthController::class)->group(function() {
    Route::post('/logout', 'logout');
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

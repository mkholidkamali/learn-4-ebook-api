<?php

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

Route::apiResource('/books', BookController::class);

Route::controller(CategoryController::class)->group(function() {
    Route::get("/category", 'index');
    Route::post("/category", 'store');
    Route::get("/category/{id}", 'show');
    Route::put("/category/{id}", 'update');
    Route::delete("/category/{id}", 'destroy');
    Route::get("/category/find/{name}", 'find');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Models\Book;
use App\Models\Genre;

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


// ==================
Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::resource("books", BookController::class)->only(["store", "update", "destroy"]);
    Route::resource("genre", GenreController::class)->only(["store", "update", "destroy"]);
    Route::post("logOut", [AuthController::class, "logOut"]) ;
});
// ==================


// books CRUD ;
Route::get("/books", [BookController::class, "index"]);
Route::get("/books/{id}", [BookController::class, "show"]);
Route::get("/books/search/{title}", [BookController::class, "search"]);
Route::get("/books/search/author/{author}", [BookController::class, "searchAuthor"]);

// Genre Crud ;
Route::get("/genre", [GenreController::class, "index"]);
Route::get("/genre/{id}", [GenreController::class, "show"]);

// Log In | Register
Route::post("register", [AuthController::class, "register"]) ;
Route::post("logIn", [AuthController::class, "logIn"]) ;



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\BookLoanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

# Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'index']);

//Protected Routes
Route::delete('/users{id}', [AuthController::class, 'delete']);
Route::get('/users{id}', [AuthController::class, 'show']);
Route::middleware(['auth:sanctum'])->group(function () {
    //User Route
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Index route accessible to users
Route::get('/books', [BookController::class, 'index']);

// CRUD routes accessible only to authorized users/admin
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);


Route::controller(ImageController::class)->group(function() {  
    Route::delete('/image/{id}',  'deleteImage');
    Route::put('/image/{id}',  'editImage'); 
});

// Index route accessible to users
Route::controller(BookLoanController::class)->group(function() {  
    Route::get('bookloans', 'index');
    Route::post('bookloans', 'store');
    Route::get('bookloans/{id}', 'show');
    Route::put('bookloans/{id}', 'update');
    Route::delete('bookloans/{id}', 'destroy');
});


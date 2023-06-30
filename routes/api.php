<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\Admin\Transaction\IndexController as AdminTransactionController;
use App\Http\Controllers\Admin\Book\IndexController;


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

Route::get('book-all', [BookController::class, 'getAll']);
Route::get('book/{code_book}', [BookController::class, 'show']);
Route::post('create-book', [BookController::class, 'store']);
Route::post('update-book/{code_book}', [BookController::class, 'update']);
Route::post('delete-book/{code_book}', [BookController::class, 'delete']);

Route::post('transaction/status/{id}', [AdminTransactionController::class, 'approve']);
Route::post('delete-book/{id}', [IndexController::class, 'clear']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

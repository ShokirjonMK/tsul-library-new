<?php

use App\Http\Controllers\Api\ApiController;
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
// ApiController
Route::prefix('v1/')->group(function () {
    Route::get('book-types', [ApiController::class, 'bookTypes'])->name('api.bookTypes');
    Route::get('book-languages', [ApiController::class, 'bookLanguages'])->name('api.bookLanguages');
    Route::get('book-texts', [ApiController::class, 'bookTexts'])->name('api.bookTexts');
    Route::get('book-text-types', [ApiController::class, 'bookTextType'])->name('api.bookTextType');
    Route::get('book-file-types', [ApiController::class, 'bookFileTypes'])->name('api.bookFileTypes');
    Route::get('subjects', [ApiController::class, 'subjects'])->name('api.subjects');
    Route::get('whos', [ApiController::class, 'whos'])->name('api.whos');
    Route::get('wheres', [ApiController::class, 'wheres'])->name('api.wheres');
    Route::get('books', [ApiController::class, 'books'])->name('api.books');
    Route::get('books/{id}', [ApiController::class, 'booksshow'])->name('api.booksshow');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

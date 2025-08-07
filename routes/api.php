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

Route::middleware('basic.custom')->prefix('v1/')->group(function () {
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
    Route::get('books-inventars', [ApiController::class, 'inventars'])->name('api.book-inventars');

    Route::get('books-inventars/{id}', [ApiController::class, 'booksshow'])->name('api.inventars-booksshow');



    Route::get('books-inventars/{id}/isalarmon', [ApiController::class, 'bookInventarByRfid'])->name('api.inventars-getByRfid');

    Route::get('books-inventars/{id}/getbook', [ApiController::class, 'geInventarByRfidCode'])->name('api.geInventarByRfidCode');

    Route::get('books-rfid/{id}', [ApiController::class, 'booksrfid'])->name('api.inventars-booksrfid');
    Route::get('users-rfid/{id}', [ApiController::class, 'usersrfid'])->name('api.inventars-usersrfid');
    Route::post('user-books-add-debt', [ApiController::class, 'addBookDebtors'])->name('api.addBookDebtors');

    Route::post('user-book-accept', [ApiController::class, 'accept'])->name('api.accept');
    Route::post('user-book-accept-by-rfid', [ApiController::class, 'acceptByRfid'])->name('api.acceptByRfid');
    Route::post('taken-book-without-permission', [ApiController::class, 'takenBookWithoutPermission'])->name('api.takenBookWithoutPermission');


});

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::get('v1/books', [ApiController::class, 'books'])->name('api.books');
//     Route::post('register', 'Auth\AuthController@register')->name('api.register');
//     Route::post('forgot-password', 'Auth\ForgotPasswordController@forgotPassword')->name('api.forgot-password');
//     Route::post('login', 'Auth\AuthController@login')->name('api.login');
//     Route::middleware('jwt.auth')->post('logout', 'Auth\AuthController@logout')->name('api.logout');
//     Route::middleware('auth')->post('refresh', 'Auth\AuthController@refresh')->name('api.refresh');
//     Route::middleware('jwt.auth')->post('me', 'Auth\AuthController@me')->name('api.me');
// });

// Route::group(['middleware' => ['auth:web,api']], function () {
//     // Route::get('/abc', 'MyController@abc');
//     Route::get('v1/books', [ApiController::class, 'books'])->name('api.books');
// });

// Route::group(['prefix' => 'auth', namespace =>'App\Http\Controller'], function () {
//     Route::post('login', 'Auth\AuthController@login')->name('api.login');

//     Route::group(['middleware' => 'auth:api'], function () {
//         Route::post('register', 'Auth\AuthController@register')->name('api.register');
//         Route::post('forgot-password', 'Auth\ForgotPasswordController@forgotPassword')->name('api.forgot-password');
//         Route::post('logout', 'Auth\AuthController@logout')->name('api.logout');
//     });
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('v1/books', [ApiController::class, 'books'])->name('api.books');
    Route::get('v1/inventars', [ApiController::class, 'inventars'])->name('api.inventars');

    Route::post('/logout', 'App\Http\Controllers\Auth\ApiAuthController@logout')->name('logout.api');
});
Route::group(['middleware' => ['api']], function () {
    Route::post('/login', 'App\Http\Controllers\Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','App\Http\Controllers\Auth\ApiAuthController@register')->name('register.api');
});

// Route::group([
//     'as' => 'passport.',
//     'prefix' => config('passport.path', 'oauth'),
//     'namespace' => '\Laravel\Passport\Http\Controllers',
// ], function () {
//     // Passport routes...
//     Route::get('v1/books', [ApiController::class, 'books'])->name('api.books');
//     Route::get('v1/books/{id}', [ApiController::class, 'booksshow'])->name('api.booksshow');

// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

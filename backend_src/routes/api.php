<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth::routes(['verify' => true]);

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');

//TODO add middleware api:auth
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@getResetData')->name('password.reset');

//TODO add middleware api:auth
Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
//Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');


Route::middleware(['auth:api'])->group(function () {
    Route::resource('programs', 'ProgramController')->only([
        'index', 'store', 'update', 'destroy'
    ]);
});

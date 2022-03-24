<?php
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
/*
Route::get('/', function () {
    return view('layouts.app');
});
*/
Route::get('setlocale/{locale}',function($lang){
    \Session::put('locale',$lang);
    return redirect()->back();
});

Route::group(['middleware'=>'language'],function () {
    Route::get('/', 'LandingController@index');

    Route::get('about', 'LandingController@about')->name('about');
    Route::get('service', 'LandingController@service')->name('service');
    Route::get('token', 'LandingController@token')->name('token');
    Route::get('faq', 'LandingController@faq')->name('faq');
    Route::get('price', 'LandingController@price')->name('price');
    Route::get('news', 'LandingController@news')->name('news');
    Route::post('send-email', 'LandingController@sendEmail')->name('send-email');

    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

    Auth::routes();
    Route::post('login', 'Auth\LoginController@authenticate')->name('login');
    Route::get('registro','Auth\RegisterController@showRegistrationForm')->name('registro');

    Route::get('/download/{file}', 'DownloadsController@download');
});

//Route::get('/home', 'HomeController@index')->name('home');


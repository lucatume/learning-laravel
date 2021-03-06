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

Route::get( '/', function () {
    return view( 'home' );
} );

/*
 * We only want users to authenticate via Google and tri.be email.
 */
Route::get( 'login/google', 'Auth\LoginController@redirectToProvider' )->name( 'login' );
Route::get( 'login/google/callback', 'Auth\LoginController@handleProviderCallback' );
Route::post( 'logout', 'Auth\LoginController@logout' )->name( 'logout' );

Route::get( '/home', 'HomeController@index' )->name( 'home' );

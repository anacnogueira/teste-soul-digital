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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

    Route::resource('tipos', 'TypeController');
    Route::resource('usuarios', 'UserController');

    Route::get('storage/users/{filename}', [
        'as'   => 'user.image',
        'uses' => 'UserController@getImage',
    ]);

    Route::resource('tickets', 'TicketController');
    
    
    Route::post('respostas/store/{ticket_id}', ['as' =>'respostas.store', 'uses' => 'RespostaController@store']);
    

    //Perfil
	Route::get('/settings', ['as' =>'usuarios.profile', 'uses' => 'UserController@profile']);
});

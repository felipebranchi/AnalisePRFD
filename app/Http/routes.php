<?php

/**
 * @package    EcoService.EcoServiceWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::resource('solicitacao', 'SolicitacaoController');
Route::resource('user', 'UserController');
Route::get('/redefinir-senha', 'UserController@redefinirsenha')->name('redefinir-senha');
Route::patch('/redefinir-senha-update', 'UserController@updatepassword')->name('redefinir-senha-update');

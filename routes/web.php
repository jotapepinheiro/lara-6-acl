<?php

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@home')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::group(['middleware' => ['role:super|admin']], function () {
        Route::resource('usuarios', 'Admin\UsuarioController');
        Route::resource('perfis', 'Admin\PerfilController');
        Route::resource('permissoes', 'Admin\PermissaoController');
    });

    Route::resource('clientes', 'Admin\ClienteController');
});


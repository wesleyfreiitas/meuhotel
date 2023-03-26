<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/categorias','ControladorCategoria@indexJSON');

Route::get('/produtos', 'ControladorProduto@indexJSON');

Route::get('/home', 'HomeController@index');

Route::get('/hospedes','ControleHospede@indexView');

Route::get('/quartos','ControleQuarto@indexView')->name('bedrooms');

Route::get('/reservas','ControleComanda@indexView')->name('reservations');

Route::get('/indicadores','ControleIndicadores@index')->name('indicators');

Route::get('/transaction','ControleTransaction@index');

Route::get('/admin','ControleIndicadores@index')->name('admin.dashboard');

Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');

Route::get('/admin/password/reset', 'Auth\AdminLoginController@recovery')->name('admin.recovery');

Route::get('/admin/register', 'AdminRegisterController@index')->name('admin.register');

Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::post('/admin/register', 'AdminRegisterController@registro')->name('admin.register.submit');

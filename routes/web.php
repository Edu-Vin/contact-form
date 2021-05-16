<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Contact\ContactController@create')->name('contact');
Route::post('contact/create', 'Contact\ContactController@store')->middleware('throttle:1,5')->name('contact.create');

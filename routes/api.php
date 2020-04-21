<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Comment;

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

Route::get('comment/{id}/{idUsr}', 'CommentController@show');
Route::post('comment', 'CommentController@store');
Route::put('comment/{id}', 'CommentController@update');
Route::delete('comment/{id}', 'CommentController@delete');
Route::post('react', 'CommentController@react');

Route::delete('react/{id}/{idUsr}', 'CommentController@unReact');
Route::resource('comment', 'CommentController');
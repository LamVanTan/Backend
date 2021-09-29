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

Route::post('/register', 'ApiUserController@register');

Route::post('/login', 'ApiUserController@login');

Route::get('/user', 'ApiUserController@userInfo')->middleware('auth:api');

Route::post('/logout', 'ApiUserController@logout')->middleware('auth:api');

Route::resource('/post', 'ApiPostController')->middleware('auth:api');
Route::put('/post/{id}/update', 'ApiPostController@updatePost')->middleware('auth:api');
Route::post('/post-delete/{id}', 'ApiPostController@deletePost')->middleware('auth:api');

Route::get('/post-public', 'ApiPostController@getListPostPublic');
Route::get('/post-detail/{id}', 'ApiPostController@getPostDetail');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

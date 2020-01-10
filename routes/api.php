<?php

use Illuminate\Http\Request;

Route::post('/v1/register','Api\V1\AuthController@register');
Route::post('/v1/login','Api\V1\AuthController@login');

Route::group(
	[
       'prefix'=>'v1',
       'namespace'=>'Api\V1',
       'middleware'=>'auth:api'
    ], function(){
    	Route::get('/profile','AuthController@profile');
    	Route::post('/logout','AuthController@logout');
    }
);

<?php

use Illuminate\Http\Request;

Route::post('/v1/register','Api\V1\AuthController@register');
Route::post('/v1/login','Api\V1\AuthController@login');

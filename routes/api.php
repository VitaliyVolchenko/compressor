<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// compress 
Route::post('/compress', 'CompressorController@compress');
// decompress
Route::post('/decompress', 'CompressorController@decompress');
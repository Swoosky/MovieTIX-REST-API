<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ticket', 'Api\TicketController@index');
Route::get('ticket/{user}', 'Api\TicketController@indexOneUser');   
Route::get('ticket/{id}', 'Api\TicketController@show');
Route::post('ticket', 'Api\TicketController@store');
Route::put('ticket/{id}', 'Api\TicketController@update');
Route::delete('ticket/{id}', 'Api\TicketController@destroy');
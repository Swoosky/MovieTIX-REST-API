<?php

use App\Http\Controllers\Api\TicketController;
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

Route::get('ticket', [TicketController::class, 'index']);
Route::get('ticket/{name}', [TicketController::class, 'indexOneUser']);
Route::get('ticket/{id}', [TicketController::class, 'show']);
Route::post('ticket', [TicketController::class, 'store']);
Route::put('ticket/{id}', [TicketController::class, 'update']);
Route::delete('ticket/{id}', [TicketController::class, 'destroy']);
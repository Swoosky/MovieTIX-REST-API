<?php

use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UserController;
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

// Settingan Class TicketApi
/*
public class TicketApi {
    public static final String BASE_URL = "hhttps://api-movietix.herokuapp.com/api/";
    public static final String GET_ALL_URL = BASE_URL + "ticket";
    public static final String GET_BY_ID_URL = BASE_URL + "ticket/";
    public static final String ADD_URL = BASE_URL + "ticket";
    public static final String UPDATE_URL = BASE_URL + "ticket/";
    public static final String DELETE_URL = BASE_URL + "ticket/";
}
*/


// Cara pake Api

// Buat tampil semua
// GET https://api-movietix.herokuapp.com/api/ticket/
Route::get('ticket', [TicketController::class, 'index']);

// Buat tampil yang dari 1 user spesifik
// GET https://api-movietix.herokuapp.com/api/ticket/user/<Nama user masuk disini>
Route::get('ticket/user/{name}', [TicketController::class, 'indexOneUser']);

// Buat tampil 1 tiket aja pake id tiket nya
// GET https://api-movietix.herokuapp.com/api/ticket/<id>
Route::get('ticket/{id}', [TicketController::class, 'show']);

// Buat masukkin data
// POST https://api-movietix.herokuapp.com/api/ticket/
Route::post('ticket', [TicketController::class, 'store']);

// Buat update data
// PUT https://api-movietix.herokuapp.com/api/ticket/<id tiket yg mau diedit>
Route::put('ticket/{id}', [TicketController::class, 'update']);

// Buat delete data
// DELETE https://api-movietix.herokuapp.com/api/ticket/<id tiket yg mau didelete>
Route::delete('ticket/{id}', [TicketController::class, 'destroy']);



// API USER
Route::get('profile', [UserController::class, 'index']);

// Buat tampil 1 tiket aja pake id tiket nya
// GET https://api-movietix.herokuapp.com/api/profile/<id>
Route::get('profile/{id}', [UserController::class, 'show']);

// Buat masukkin data
// POST https://api-movietix.herokuapp.com/api/profile/
Route::post('profile', [UserController::class, 'store']);

// Buat update data
// PUT https://api-movietix.herokuapp.com/api/profile/<id profile yg mau diedit>
Route::put('profile/{id}', [UserController::class, 'update']);

// Buat delete data
// DELETE https://api-movietix.herokuapp.com/api/profile/<id profile yg mau didelete>
Route::delete('profile/{id}', [UserController::class, 'destroy']);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;


Route::middleware('auth:api')->group(function() {
    Route::get('/attendances', [AttendanceController::class, 'index']); // Liste des pointages
    Route::get('/attendances/{id}', [AttendanceController::class, 'show']); // Détail d’un pointage
    Route::post('/attendances', [AttendanceController::class, 'store']); // Ajouter un pointage
    // Ajoutez d’autres routes selon vos besoins
});

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
// # Removed for optimization #
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');
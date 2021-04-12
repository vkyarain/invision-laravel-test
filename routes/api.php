<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FbpostController;
use App\Http\Controllers\PostlikeController;
use App\Http\Controllers\PostcommentsController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/



Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('fbposts', [FbpostController::class, 'index']);
    Route::get('fbposts/{id}', [FbpostController::class, 'show']);
    Route::post('create', [FbpostController::class, 'store']);
    Route::put('update/{fbpost}',  [FbpostController::class, 'update']);
    Route::delete('delete/{fbpost}',  [FbpostController::class, 'destroy']);
	
    Route::post('like', [PostlikeController::class, 'store']);
    Route::post('comments', [PostcommentsController::class, 'store']);
	
	
	
	
	
	
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('post', PostController::class);
    Route::post('post/{postId}/vote', [PostController::class, 'vote']);
    // Route::post('post/{postId}/add/comment',[CommentController::class,'store']);
    Route::group(['prefix' => 'post/{postId}'], function () {
        Route::put('comment/{commentId}', [CommentController::class, 'update']);
        Route::post('comment/{commentId}', [CommentController::class, 'store']);
    });
    Route::resource('comment', CommentController::class);

});


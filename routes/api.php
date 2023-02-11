<?php

use App\Http\Controllers\Api\V1\SkillController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function() {
    Route::get('me', [AuthController::class, 'me']);
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('skills', SkillController::class);
        Route::get('comments/{id}', [CommentController::class, 'index']);
        Route::post('store/comment', [CommentController::class, 'store']);
        Route::post('logout', [AuthController::class, 'logout']);
        
    });
    
    Route::middleware('guest:api')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });
    Route::get('/test', function () {
        return 'Hello World';
    });
    
    
    
    // Route::get('user', [SessionsController::class, 'user'])->middleware('auth');
    // Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
    // Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');
});




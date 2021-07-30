<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TestController;

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


//* Protected Routes

Route::group(['middleware' => ['auth:sanctum']], function () {

    //** Posts Api */



    Route::post('/post', [PostController::class, 'store']);

    Route::put('/post/{id}', [PostController::class, 'update']);

    Route::delete('/post/{id}', [PostController::class, 'destroy']);

    Route::get('/posts', [PostController::class, 'index']);


    //** Comments Api */
    Route::post('/comment', [CommentController::class, 'store']);
    Route::post('/test', [TestController::class, 'test']);
});

// Route::get('/comment/user/{id}', [CommentController::class, 'userComments']);

Route::get('/comments', [CommentController::class, 'index']);



Route::put('/comment/{id}', [CommentController::class, 'update']);

Route::delete('/comment/{id}', [CommentController::class, 'destroy']);

Route::get('/user', [AuthController::class, 'user']);

//* Public Routes A




    Route::post('/signup', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/admin/signup', [AdminController::class, 'register']);


//** Post Api */

    Route::get('/search/{title}', [PostController::class, 'search']);

    Route::get('/post/{id}', [PostController::class, 'show']);








// Route::resource('posts', PostController::class);

// Route::group(['middleware' => ['auth:user']], function () {
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

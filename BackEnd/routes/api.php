<?php

use App\Http\Controllers\AdminController;
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



//* Public Routes

// Route::resource('posts', PostController::class);

Route::post('/signup', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);


Route::get('/post/{id}', [PostController::class, 'show']);

Route::get('/search/{title}', [PostController::class, 'search']);

Route::post('/admin/signup', [AdminController::class, 'register']);

Route::group(['middleware' => ['auth:user']], function () {
    Route::get('/post', [PostController::class, 'index']);
});





//* Protected Routes



Route::group(['middleware' => ['auth:sanctum']], function () {


    //** Post Api */

    Route::post('/posts', [PostController::class, 'store']);

    Route::put('/post/{id}', [PostController::class, 'update']);

    Route::delete('/post/{id}', [PostController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);


    //** Comments Api */

    Route::get('/comment/user/{id}', [CommentController::class, 'userComments']);

    Route::get('/comment/post/{id}', [CommentController::class, 'postComments']);

    Route::post('/comment', [CommentController::class, 'store']);

    Route::put('/comment/{id}', [CommentController::class, 'update']);

    Route::delete('/comment/{id}', [CommentController::class, 'destroy']);

    Route::get('/user', [AuthController::class, 'user']);
});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

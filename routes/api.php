<?php

use App\Http\Controllers\BookController;
use App\Http\Resources\UserResource;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Resourceful routes for BookController
Route::resource('books', BookController::class)
->except(['create', 'edit']);

Route::get('/user/{id}', function(string $id) {
    if(ctype_digit($id)){
        return new UserResource(User::findOrFail($id));
    } else {
        return response()->json(['error'=>'Bad Request'], 400);
    }
});

Route::get('/users', function() {
    return UserResource::collection(User::paginate());
});
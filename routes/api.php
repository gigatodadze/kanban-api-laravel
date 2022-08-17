<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Http\Resources\StateResource;
use App\Models\State;
use App\Http\Controllers\TaskController;

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
//Route::get('/states', [StateController::class, 'index']);
//Route::post('/states', [StateController::class, 'store']);
//Route::put('/states/{states}', [StateController::class, 'update']);
//Route::delete('/states/{states}', [StateController::class, 'destroy']);

Route::get('/user/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});
Route::get('/users', function () {
    return UserResource::collection(User::all());
});

Route::apiResource('states', StateController::class);

Route::apiResource('tasks', TaskController::class);

//Route::get('/tasks', function ($id) {
//    return TaskResource::collection(Task::all());
//});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

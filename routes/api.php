<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ChatController;
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
Route::post("login",[ChatController::class,'login'])->name("login");

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::get("/user",function(Request $request){return $request->user();});

    Route::get("/conversations",[ChatController::class,"userConversations"])->name("conversation");

    Route::post("/message/{conversationId}",[ChatController::class,"sendMessage"])->name("message.send");

    Route::get("/messages/{conversationId}",[ChatController::class,"messages"])->name("messages");
});


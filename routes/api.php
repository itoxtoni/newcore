<?php

use App\Dao\Enums\Core\LevelType;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Core\GroupsController;
use App\Http\Controllers\Core\UserController;
use App\Http\Controllers\Core\WebhookController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Route::post('login', [UserController::class, 'postLoginApi'])->name('postLoginApi');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile', [UserController::class, 'getProfile']);
    Route::post('profile', 'App\Http\Controllers\Core\UserController@updateProfile');
    Route::post('register', [UserController::class, 'postCreate'])->name('register');

    Route::auto('api-user', UserController::class);

    Route::get('level', function(){
        $level = LevelType::getApi();
        return $level;
    });

});

Route::get('groups', [GroupsController::class, 'getData']);
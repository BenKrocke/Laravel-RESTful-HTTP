<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WizardController;
use App\Http\Controllers\SpellController;
use App\Http\Controllers\SpellTypeController;

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

Route::group(['middleware' => 'content_negotiation'], function () {
    Route::apiResources([
        'wizards' => WizardController::class,
        'spells' => SpellController::class,
        'spell_types' => SpellTypeController::class
    ]);
});

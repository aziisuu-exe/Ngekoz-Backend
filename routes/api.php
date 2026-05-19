<?php

use App\Http\Controllers\Api\Admin\KosPlaceController as AdminKosPlaceController;
use App\Http\Controllers\Api\Admin\KosVerificationController;
use App\Http\Controllers\Api\Admin\ManageKosController;
use App\Http\Controllers\Api\Admin\ManageUserController; 
use App\Http\Controllers\Api\Admin\OwnerController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\KosPlaceController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\Owner\KosController as OwnerKosController;
use App\Http\Controllers\Api\PhotoTypeController;
use App\Http\Controllers\Api\Public\KosController as PublicKosController;
use App\Http\Controllers\Api\RuleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/webhook/xendit', [WebhookController::class, 'xenditCallback']);

Route::get('/kos', [KosPlaceController::class, 'index']);
Route::get('/kos/{id}', [KosPlaceController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);

    Route::middleware('role:owner')->prefix('owner')->group(function () {
        Route::post('/kos', [OwnerKosController::class, 'store']);
    });

    Route::post('/owner/kos', [OwnerKosController::class, 'store'])->middleware('role:owner');

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/kos/unverified', [KosVerificationController::class, 'unverifiedKos']);
        Route::patch('/kos/{id}/verify', [KosVerificationController::class, 'verify']);
        Route::get('/kos', [ManageKosController::class, 'index']);
        Route::delete('/kos/{id}', [ManageKosController::class, 'destroy']);
        Route::get('/users', [ManageUserController::class, 'index']);
        Route::patch('/users/{id}/role', [ManageUserController::class, 'updateRole']);
        Route::delete('/users/{id}', [ManageUserController::class, 'destroy']);
    });
});

Route::get('/kos', [PublicKosController::class, 'index']);

Route::get('/cities', [LocationController::class, 'getCities']);
Route::post('/cities', [LocationController::class, 'storeCity']);
Route::put('/cities/{id}', [LocationController::class, 'updateCity']);
Route::delete('/cities/{id}', [LocationController::class, 'destroyCity']);
Route::get('/cities/all', [LocationController::class, 'getAllCities']);

Route::post('/districts', [LocationController::class, 'storeDistrict']);
Route::put('/districts/{id}', [LocationController::class, 'updateDistrict']);
Route::delete('/districts/{id}', [LocationController::class, 'destroyDistrict']);
Route::get('/districts', [LocationController::class, 'getDistricts']);

Route::get('/facilities', [FacilityController::class, 'index']);
Route::post('/facilities', [FacilityController::class, 'store']);
Route::put('/facilities/{id}', [FacilityController::class, 'update']);
Route::delete('/facilities/{id}', [FacilityController::class, 'destroy']);

Route::get('/rules', [RuleController::class, 'index']);
Route::post('/rules', [RuleController::class, 'store']);
Route::put('/rules/{id}', [RuleController::class, 'update']);
Route::delete('/rules/{id}', [RuleController::class, 'destroy']);

Route::get('/kos-rules', [RuleController::class, 'getKosList']);
Route::get('/kos-rules/{id}', [RuleController::class, 'getKosRulesDetail']);
Route::post('/kos-rules/{id}/sync', [RuleController::class, 'syncKosRules']);

Route::get('/banks', [BankController::class, 'index']);
Route::post('/banks', [BankController::class, 'store']);
Route::put('/banks/{id}', [BankController::class, 'update']);
Route::delete('/banks/{id}', [BankController::class, 'destroy']);

Route::get('/photo-types', [PhotoTypeController::class, 'index']);
Route::post('/photo-types', [PhotoTypeController::class, 'store']);
Route::put('/photo-types/{id}', [PhotoTypeController::class, 'update']);
Route::delete('/photo-types/{id}', [PhotoTypeController::class, 'destroy']);

Route::get('/kos-places', [AdminKosPlaceController::class, 'index']);
Route::post('/kos-places', [AdminKosPlaceController::class, 'store']);
Route::put('/kos-places/{id}', [AdminKosPlaceController::class, 'update']);
Route::delete('/kos-places/{id}', [AdminKosPlaceController::class, 'destroy']);
Route::get('/public/kos-places', [KosPlaceController::class, 'index']);
Route::get('/public/kos-places/{id}', [KosPlaceController::class, 'show']);

Route::prefix('admin')->group(function () {
    Route::get('/owners', [OwnerController::class, 'index']);
    Route::post('/owners', [OwnerController::class, 'store']);
    Route::put('/owners/{id}', [OwnerController::class, 'update']);
    Route::delete('/owners/{id}', [OwnerController::class, 'destroy']);
});
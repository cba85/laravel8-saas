<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthTokenController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\PlanController;

Route::post('auth/register', [AuthTokenController::class, 'register']);
Route::post('auth/login', [AuthTokenController::class, 'login']);
Route::middleware('auth:sanctum')->post('auth/me', [AuthTokenController::class, 'me']);
Route::middleware('auth:sanctum')->post('auth/logout', [AuthTokenController::class, 'logout']);

Route::get('plans', [PlanController::class, 'index']);

Route::middleware('auth:sanctum')->post('stripe/intent', [StripeController::class, 'intent']);
Route::middleware('auth:sanctum')->post('stripe/subscribe', [StripeController::class, 'subscribe']);

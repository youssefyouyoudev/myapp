<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserStatsController;
use App\Http\Controllers\DashboardController;

// Public routes
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
	// Auth
	Route::post('logout', [AuthController::class, 'logout']);
	Route::get('me', [AuthController::class, 'me']);

	// User stats/reporting
	Route::get('users/me/stats', [UserStatsController::class, 'stats']);
	Route::get('users', [AuthController::class, 'getAllUsers']);

	// Subscription Plans CRUD
	Route::apiResource('subscription-plans', App\Http\Controllers\SubscriptionPlanController::class);

	// Voyage Plans CRUD
	Route::apiResource('voyage-plans', App\Http\Controllers\VoyagePlanController::class);

	// Clients (students)
	Route::apiResource('clients', ClientController::class);

	// Cards
	Route::apiResource('cards', CardController::class);
	Route::post('cards/{card}/block', [CardController::class, 'block']);
	Route::post('cards/{card}/unblock', [CardController::class, 'unblock']);
	// Card scan (NFC)
	Route::get('cards/{nfc_uid}/scan', [CardController::class, 'scan']);
	// Link card to client
	Route::post('cards/{card}/link', [CardController::class, 'linkToClient']);

	// Charging endpoints (only one active plan at a time)
	Route::post('clients/{client}/charge-subscription', [SubscriptionController::class, 'charge']);
	Route::post('clients/{client}/charge-voyage', [VoyageController::class, 'charge']);

	// Voyages (NFC scans)
	Route::apiResource('voyages', VoyageController::class)->only(['index', 'store', 'show']);

	// Payments (card charges)
	Route::apiResource('payments', PaymentController::class)->only(['index', 'store', 'show']);

	// Subscriptions
	Route::apiResource('subscriptions', SubscriptionController::class);

	// Dashboard route
	Route::get('dashboard', [DashboardController::class, 'index']);
});

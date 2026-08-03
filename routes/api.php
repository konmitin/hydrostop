<?php

use App\Http\Controllers\Api\BranchApiController;
use App\Http\Controllers\Api\CallApiController;
use App\Http\Controllers\Api\SertificateApiController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductFileController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CallController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
Route::apiResource('products.images', ProductImageController::class)->middleware('auth:sanctum');
Route::apiResource('products.files', ProductFileController::class)->middleware('auth:sanctum');

Route::apiResource('calls', CallApiController::class)->middleware('auth:sanctum');
Route::apiResource('orders', OrderController::class)->middleware('auth:sanctum');
Route::apiResource('clients', ClientController::class)->middleware('auth:sanctum');
Route::apiResource('users', UserController::class)->middleware('auth:sanctum');

Route::apiResource('companies', CompanyController::class)->middleware('auth:sanctum');
Route::apiResource('sertificates', SertificateApiController::class)->middleware('auth:sanctum');

Route::apiResource('branches', BranchApiController::class)->middleware('auth:sanctum');
Route::apiResource('statuses', StatusController::class)->middleware('auth:sanctum');
Route::apiResource('categories', CategoryController::class)->middleware('auth:sanctum');
Route::apiResource('properties', PropertyController::class)->middleware('auth:sanctum');
Route::apiResource('units', UnitController::class)->middleware('auth:sanctum');

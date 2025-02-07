<?php

use App\Http\Controllers\Api\ApiAdminVendorProfileController;
use App\Http\Controllers\api\ApiBrandController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\api\apiVendorProductController;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/csrf-cookie', function (Request $request) {
    return response()->json([
        'csrf' => $request->session()->token()
    ]);
});


// Auth APIs
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'destroy'])->name('logout');
// Vendor APIs
Route::middleware(['auth:sanctum', 'role.api:vendor'])->group(function () {
    Route::get('/vendor/products', [ApiVendorProductController::class, 'index']);
    Route::post('/vendor/products', [ApiVendorProductController::class, 'store']);
    Route::get('/vendor/products/{id}', [ApiVendorProductController::class, 'edit']);
    Route::put('/vendor/products/{id}', [ApiVendorProductController::class, 'update']);
    Route::delete('/vendor/products/{id}', [ApiVendorProductController::class, 'destroy']);
    Route::post('/vendor/products/change-status', [ApiVendorProductController::class, 'changeStatus']);
    Route::get('/vendor/get-subcategories', [ApiVendorProductController::class, 'getSubCategories']);
    Route::get('/vendor/get-childcategories', [ApiVendorProductController::class, 'getChildCategories']);
});
// Admin/Brand APIs
Route::middleware(['auth:sanctum', 'role.api:admin'])->group(function () {
    Route::get('brands', [ApiBrandController::class, 'index']);
    Route::post('/brands', [ApiBrandController::class, 'store']);
    Route::get('/brands/{id}/edit', [ApiBrandController::class, 'edit']);
    Route::put('/brands/{id}', [ApiBrandController::class, 'update']);
    Route::delete('/brands/{id}', [ApiBrandController::class, 'destroy']);
    Route::post('/brands/change-status', [ApiBrandController::class, 'changeStatus']);
});
// Admin Vendor Profile APIs
Route::middleware(['auth:sanctum', 'role.api:admin'])->group(function () {
    Route::get('/vendor-profile', [ApiAdminVendorProfileController::class, 'index']);
    Route::post('/vendor-profile/update', [ApiAdminVendorProfileController::class, 'update']);
});
// Category APIs
Route::middleware(['auth:sanctum', 'role.api:admin'])->group(function () {
    Route::get('/category', [ApiCategoryController::class, 'index']);
    Route::post('/category', [ApiCategoryController::class, 'store']);
    Route::put('/category/{id}', [ApiCategoryController::class, 'update']);
    Route::delete('/category/{id}', [ApiCategoryController::class, 'destroy']);
    Route::post('/category/change-status', [ApiCategoryController::class, 'changeStatus']);
});
// Child Category APIs
use App\Http\Controllers\Api\ApiChildCategoryController;

Route::middleware(['auth:sanctum', 'role.api:admin'])->group(function () {
    Route::get('/child-categories', [ApiChildCategoryController::class, 'index']);
    Route::post('/child-categories', [ApiChildCategoryController::class, 'store']);
    Route::put('/child-categories/{id}', [ApiChildCategoryController::class, 'update']);
    Route::delete('/child-categories/{id}', [ApiChildCategoryController::class, 'destroy']);
    Route::post('/child-categories/change-status', [ApiChildCategoryController::class, 'changeStatus']);
    Route::get('/getsub-categories', action: [ApiChildCategoryController::class, 'getSubCategories']);
});



Route::middleware(['auth:sanctum', 'role.api:admin'])->group(function () {
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    // Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser']);
});

Route::middleware(['auth:sanctum', 'role.api:vendor'])->group(function () {
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    // Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser']);
});



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\PlanController;



// Route::group([], function ($router) {
    
//     Route::post('/registeradmin', [AuthController::class, 'registeradmin']);

//     Route::post('/login', [AuthController::class,'login']);
    
//     Route::post('/refresh', [AuthController::class,'refresh']);

//     Route::post('/logout', [AuthController::class,'logout']);

// });


// Route::prefix('faq')->group(function () {
    
//     Route::get('/categories', [FaqController::class, 'indexCategory']); 
//     Route::post('/categories', [FaqController::class, 'storeCategory']);
//     Route::get('/categories/{id}', [FaqController::class, 'showCategory']);
//     Route::put('/categories/{id}', [FaqController::class, 'updateCategorye']);
//     Route::delete('/categories/{id}', [FaqController::class, 'deleteCategorye']);

//     Route::post('/', [FaqController::class, 'createFaq']);
//     Route::get('/', [FaqController::class, 'getAllFaqs']);
//     Route::get('/{id}', [FaqController::class, 'getFaq']);
//     Route::get('/category/{categoryID}', [FaqController::class, 'getFaqByCategory']);
//     Route::put('/{id}', [FaqController::class, 'updateFaq']); 
//     Route::delete('/{id}', [FaqController::class, 'deleteFaq']);

// });


// Route::prefix('services')->group(function () {
    
//     Route::post('/', [ServiceController::class, 'storeService']);
//     Route::get('/', [ServiceController::class, 'indexService']);
//     Route::get('/{id}', [ServiceController::class, 'showService']);   
//     Route::put('/{id}', [ServiceController::class, 'updateService']); 
//     Route::delete('/{id}', [ServiceController::class, 'deleteService']);
    
    
//     Route::post('/sub', [ServiceController::class, 'createSubService']);
//     Route::get('/sub/{id}', [ServiceController::class, 'getSubService']);
//     Route::get('/subs/{serviceID}', [ServiceController::class, 'getSubServiceByService']);
//     Route::put('/sub/{id}', [ServiceController::class, 'updateSubService']);
//     Route::delete('/sub/{id}', [ServiceController::class, 'deleteSubService']);

//     Route::get('/subs', [ServiceController::class, 'getAllSubServices']); 
   
// });


// Route::prefix('postal-codes')->group(function () {
    
//     Route::post('/', [PostalCodeController::class, 'store']);
//     Route::get('/', [PostalCodeController::class, 'index']);
//     Route::get('/{id}', [PostalCodeController::class, 'show']);   
//     Route::put('/{id}', [PostalCodeController::class, 'update']); 
//     Route::delete('/{id}', [PostalCodeController::class, 'delete']);
       
// });


// Route::prefix('plans')->group(function () {
    
//     Route::post('/', [PlanController::class, 'store']);
//     Route::get('/', [PlanController::class, 'index']);
//     Route::get('/{id}', [PlanController::class, 'show']);   
//     Route::put('/{id}', [PlanController::class, 'update']); 
//     Route::delete('/{id}', [PlanController::class, 'delete']);
       
// });


// Route::get('/subs', function () {
//     return response()->json(['message' => 'Route is working!']);
// });

// Route::middleware(['auth:admin-api'], function ($router) {

    
// });

// # Routes accessible by 'professional' admin
// Route::middleware(['auth:api', 'role:admin'])->group(function() {
//     Route::get('/admin', function () {
//        return 'admin';
//     });
// });


// # Routes accessible by 'professional' client
// Route::middleware(['auth:api', 'role:client'])->group(function() {
//     Route::get('/client', function () {
//         return 'client';
//      });
// });



// # Routes accessible by 'professional' roles
// Route::middleware(['auth:api', 'role:professional'])->group(function() {
//     Route::get('/professional', function () {
//         return 'professional';
//      });

// });
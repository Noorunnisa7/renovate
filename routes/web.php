<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\leadsController;


Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [AuthController::class,'viewlogin'])->name('login');

Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');
Route::post('/login', [AuthController::class,'login']);



Route::middleware(['auth' , 'checkCache'])->group(function () {
    
    Route::post('/create', [AdminController::class, 'registeradmin']);

    Route::get('/create', [AdminController::class, 'viewRegister'])->name('create');
    Route::get('/list', [AdminController::class,'adminView']);
    Route::get('/edit', [AdminController::class,'adminEdit']);

    Route::get('/dashboard', [AuthController::class,'dashboard']);
    Route::get('/profile', [AuthController::class,'me']);
});

Route::middleware(['checkCache'])->group(function () {
  
    
});


Route::get('/logout', [AuthController::class,'logout'])->name('logout');


Route::get('/leads/list', [leadsController::class,'leadsView']);
Route::get('/leads/create', [leadsController::class,'leadsCreate'])->name('createLead');
// Route::get('/leads/list', [AdminController::class,'leadsView']);
// Route::get('/leads/list', [AdminController::class,'leadsView']);



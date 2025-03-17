<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\userAuthController;
use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\Vendors\VendorDashboard;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Kernel;



Route::get('/', [WebsiteController::class, 'index']);
Route::get('/home', [WebsiteController::class, 'index']);


Route::middleware('guest')->group(function(){
//Inscription
    Route::get('/register', [userAuthController::class, 'register'])->name('user.register');
    Route::post('/register', [userAuthController::class, 'handleRegister'])->name('user.handleRegister');

//Connexion
    Route::get('/login', [userAuthController::class, 'login'])->name('user.login');
    Route::post('/login',[userAuthController::class, 'handleLogin'])->name('user.handleLogin');
});

//Route pour les utilisateur
Route::middleware('auth')->group(function(){
//Deconnexion
    Route::get('/logout', [userAuthController::class, 'handleLogout'])->name('user.logout');

});

//Route pour les vendeur

//VENDUER [Auth]
Route::prefix('vendors/accounts')->group(function(){
    Route::get('/login',[VendorAuthController::class, 'login'])->name('vendors.login');
    Route::get('/register',[VendorAuthController::class, 'register'])->name('vendors.register');

    Route::post('/register', [VendorAuthController::class, 'handleRegister'])->name('vendors.handleRegister');
    Route::post('/login',[VendorAuthController::class, 'handleLogin'])->name('vendors.handleLogin');
});



Route::prefix('vendors/dashboard')
    //->middleware('vendor_middleware')  // L'alias est bien enregistré ici
   ->group(function () {
    Route::get('/', [VendorDashboard::class, 'index'])->name('vendors.dashboard');
    // autres routes
Route::prefix('article')->group(function(){
    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/create', [ArticleController::class, 'handleCreate'])->name('articles.handleCreate');

    });

Route::get('/payment-config', [PaymentController::class, 'getAccountInfo'])->name('payments.config');
Route::post('/handle-payment-config', [PaymentController::class, 'handleUpdateInfo'])->name('payments.updateConfig');

Route::get('/logout',[VendorDashboard::class, 'logout'])->name('vendors.logout');

    });



<?php

use App\Http\Controllers\CustomerHomePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PaymentController;

// Home route or landing page (redirects to login page for unauthenticated users)
Route::get('/', function () {
    return auth()->check() ? redirect()->route('customershomepage.index') : redirect()->route('dashboard.content');
});

// Authentication routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard route (only accessible to authenticated users)
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::middleware('auth')->get('/dashboard/content', [DashboardController::class, 'content'])->name('dashboard.content');
// Users resource route (CRUD for users)
Route::get('homepage', [CustomerHomePageController::class, 'index'])->name('customershomepage.index');
Route::resource('/users', UserController::class);
Route::resource('/products', ProductController::class);

Route::get('/analytics', [AnalyticsController::class, 'content'])->name('analytics.content');
Route::resource('/category', CategoriesController::class);

Route::get('/products/export-pdf', [ProductController::class, 'exportPDF'])->name('products.exportPDF');
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.show');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::post('/update-transaction-id', [PaymentController::class, 'updateTransactionId']);
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.show');

Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::post('/payment/save', [PaymentController::class, 'saveTransaction'])->name('payment.save');
<?php

use App\Http\Controllers\AdminAvisController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminSessionController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\WebinaireController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [WebinaireController::class, 'index'])->name('home');
Route::post('/', [WebinaireController::class, 'store']);
Route::get('/merci', [WebinaireController::class, 'merci'])->name('merci');

Route::get('/avis/{sessionId}', [AvisController::class, 'show'])->name('avis.show');
Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');

// Admin auth (public)
Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin/forgot-password', [AdminAuthController::class, 'showForgotForm'])->name('admin.password.forgot');
Route::post('/admin/forgot-password', [AdminAuthController::class, 'sendResetLink']);
Route::get('/admin/reset-password', [AdminAuthController::class, 'showResetForm'])->name('admin.password.reset');
Route::post('/admin/reset-password', [AdminAuthController::class, 'resetPassword']);

// Admin protected routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/prospect/{id}', [AdminDashboardController::class, 'prospect'])->name('admin.prospect');

    Route::get('/admin/sessions', [AdminSessionController::class, 'index'])->name('admin.sessions');
    Route::post('/admin/sessions', [AdminSessionController::class, 'store']);
    Route::post('/admin/sessions/delete', [AdminSessionController::class, 'destroy'])->name('admin.sessions.destroy');

    Route::get('/admin/avis', [AdminAvisController::class, 'index'])->name('admin.avis');
    Route::get('/admin/avis/{id}', [AdminAvisController::class, 'show'])->name('admin.avis.detail');

    Route::get('/admin/admins', [AdminManagementController::class, 'index'])->name('admin.admins');
    Route::post('/admin/admins', [AdminManagementController::class, 'store']);
    Route::post('/admin/admins/delete', [AdminManagementController::class, 'destroy'])->name('admin.admins.destroy');

    Route::get('/admin/password', [AdminProfileController::class, 'showChangePasswordForm'])->name('admin.password.change');
    Route::post('/admin/password', [AdminProfileController::class, 'changePassword']);
});

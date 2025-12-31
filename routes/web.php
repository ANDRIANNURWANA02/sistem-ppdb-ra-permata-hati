<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ExportController;


/*
|--------------------------------------------------------------------------
| LANDING PAGE (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('profile');
})->name('profile.sekolah');

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Login & Register
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/user/beranda', [BerandaController::class, 'index'])
        ->name('user.beranda');

    // Dashboard User
    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    // Profile
    Route::get('/profil', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profil/partials', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Pendaftaran (USER)
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])
        ->name('pendaftaran.index');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');
        
     Route::get('/user/pendaftaran/edit', [PendaftaranController::class, 'editUser'])
        ->name('user.pendaftaran.edit');

    Route::put('/user/pendaftaran', [PendaftaranController::class, 'updateUser'])
        ->name('user.pendaftaran.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::post('/pendaftaran/{id}/verifikasi', [PendaftaranController::class, 'verifikasi'])->name('admin.pendaftaran.verifikasi');

    // Kelola Pendaftaran
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::get('/pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])
        ->name('pendaftaran.edit');

    Route::put('/pendaftaran/{id}', [PendaftaranController::class, 'update'])
        ->name('pendaftaran.update');

    Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])
        ->name('pendaftaran.destroy');

    Route::get('/pendaftaran/download/{jenis}/{id}', [PendaftaranController::class, 'download'])
        ->name('pendaftaran.download');
        
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::post('/admin/verifikasi/{id}', [AdminController::class, 'verifikasi'])
        ->name('admin.verifikasi');

    // EXPORT
    Route::get('/admin/export/excel', [ExportController::class, 'excel']);

    Route::get('/export/excel', [ExportController::class, 'excel'])
        ->name('export.excel');
});

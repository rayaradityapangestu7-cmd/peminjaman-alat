<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoanController;
use App\Http\Controllers\AdminReturnController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

// Login & Logout (Semua Role)
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role == 'admin') return redirect('/admin/dashboard');
        if ($role == 'petugas') return redirect('/petugas/dashboard');
        return redirect('/peminjam/dashboard');
    }
    
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('tools', ToolController::class);
    Route::resource('categories', CategoryController::class);
    
    // ADMIN LOANS - EKSPLISIT
    Route::get('/admin/loans', [AdminLoanController::class, 'index'])->name('admin.loans.index');
    Route::get('/admin/loans/create', [AdminLoanController::class, 'create'])->name('admin.loans.create');
    Route::post('/admin/loans', [AdminLoanController::class, 'store'])->name('admin.loans.store');
    Route::get('/admin/loans/{loan}', [AdminLoanController::class, 'show'])->name('admin.loans.show');
    Route::get('/admin/loans/{loan}/edit', [AdminLoanController::class, 'edit'])->name('admin.loans.edit');
    Route::put('/admin/loans/{loan}', [AdminLoanController::class, 'update'])->name('admin.loans.update');
    Route::delete('/admin/loans/{loan}', [AdminLoanController::class, 'destroy'])->name('admin.loans.destroy');
    
    // ADMIN RETURNS
    Route::get('/admin/returns', [AdminReturnController::class, 'index'])->name('admin.returns.index');
    Route::get('/admin/returns/create', [AdminReturnController::class, 'create'])->name('admin.returns.create');
    Route::post('/admin/returns', [AdminReturnController::class, 'store'])->name('admin.returns.store');
    Route::get('/admin/returns/{return}', [AdminReturnController::class, 'show'])->name('admin.returns.show');
    Route::get('/admin/returns/{return}/edit', [AdminReturnController::class, 'edit'])->name('admin.returns.edit');
    Route::put('/admin/returns/{return}', [AdminReturnController::class, 'update'])->name('admin.returns.update');
    Route::delete('/admin/returns/{return}', [AdminReturnController::class, 'destroy'])->name('admin.returns.destroy');
    
    Route::get('/admin/logs', function() {
        $logs = ActivityLog::with('user')->latest()->get();
        return view('admin.logs', compact('logs'));
    })->name('admin.logs');
});

// Group Petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
    Route::post('/petugas/approve/{loan}', [PetugasController::class, 'approve'])->name('petugas.approve');
    Route::put('/petugas/return/{loan}', [PetugasController::class, 'processReturn'])->name('petugas.return');
    Route::get('/petugas/laporan', [PetugasController::class, 'report'])->name('petugas.report');
});

// Group Peminjam
Route::middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/peminjam/dashboard', [PeminjamController::class, 'index'])->name('peminjam.dashboard');
    Route::post('/peminjam/ajukan', [PeminjamController::class, 'store'])->name('peminjam.ajukan');
    Route::get('/peminjam/riwayat', [PeminjamController::class, 'history'])->name('peminjam.riwayat');
});
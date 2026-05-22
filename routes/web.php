<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => view('auth.login'));
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/company-register', fn() => view('auth.company-register'))->name('company.register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register-company', [AuthController::class, 'registerCompany'])->name('register.company');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.supabase', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::get('/companies/{id}', [AdminController::class, 'showCompany'])->name('companies.show');
    Route::get('/lowongan', [AdminController::class, 'lowongan'])->name('lowongan.index');
    Route::get('/events', fn() => view('admin.pages.event.index'))->name('events');
    Route::get('/events/create', fn() => view('admin.pages.event.create'))->name('events.create');
    Route::post('/verify-company', [AdminController::class, 'verifyCompany'])->name('admin.verify.company');
    Route::get('/audit-log', [AdminController::class, 'auditLog'])->name('audit-log.index');
});

Route::middleware(['auth.supabase', 'role:perusahaan'])->prefix('company')->group(function () {
    Route::get('/overview', fn() => view('company.pages.overview'))->name('overview');

    Route::get('/jobs', [LowonganController::class, 'index'])->name('jobs');
    Route::get('/jobs/create', [LowonganController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [LowonganController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}', [LowonganController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{id}/edit', [LowonganController::class, 'edit'])->name('jobs.edit');
    Route::patch('/jobs/{id}', [LowonganController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [LowonganController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/applicants', [LamaranController::class, 'index'])->name('applicants');
    Route::get('/applicants/{id}/edit', [LamaranController::class, 'edit'])->name('applicants.edit');
    Route::patch('/applicants/{id}/status', [LamaranController::class, 'updateStatus'])->name('applicants.status');
    Route::get('/applicants/{id}/berkas/{tipe}', [LamaranController::class, 'downloadBerkas'])->name('applicants.berkas')->where('tipe', 'cv|portofolio|surat_lamaran|transkip_nilai|pas_foto');

    Route::get('/profile', [ProfileController::class, 'show'])->name('company.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('company.profile.update');
});

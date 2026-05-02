<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LowonganController;


Route::get('/', fn() => view('auth.login'));
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/company-register', fn() => view('auth.company-register'))->name('company.register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register-company', [AuthController::class, 'registerCompany'])->name('register.company');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.supabase', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::get('/jobs', fn() => view('admin.pages.job_listings'))->name('job_listings');
    Route::get('/events', fn() => view('admin.pages.event.index'))->name('events');
    Route::get('/events/create', fn() => view('admin.pages.event.create'))->name('events.create');
    Route::post('/verify-company', [AdminController::class, 'verifyCompany'])->name('admin.verify.company');
});

Route::middleware(['auth.supabase', 'role:perusahaan'])->prefix('company')->group(function () {
    Route::get('/overview', fn() => view('company.pages.overview'))->name('overview');

    Route::get('/jobs', [LowonganController::class, 'index'])->name('jobs');
    Route::get('/jobs/create', [LowonganController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [LowonganController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [LowonganController::class, 'edit'])->name('jobs.edit');
    Route::patch('/jobs/{id}', [LowonganController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [LowonganController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/applicants', fn() => view('company.pages.pelamar.index'))->name('applicants');
    Route::get('/applicants/show', fn() => view('company.pages.pelamar.show'))->name('applicants.show');
});

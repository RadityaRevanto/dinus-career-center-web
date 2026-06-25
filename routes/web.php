<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\NotificationController;

Route::middleware('redirect.if.authenticated')->group(function () {
    Route::get('/', fn() => view('auth.login'));
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
    Route::get('/reset-password', fn() => view('auth.reset-password'))->name('password.reset');
    Route::get('/company-register', fn() => view('auth.company-register'))->name('company.register');
});

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink'])->name('password.email');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/register-company', [AuthController::class, 'registerCompany'])->name('register.company');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.supabase', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/password', [AdminController::class, 'password'])->name('admin.password');
    Route::post('/password', [AdminController::class, 'updatePassword'])->name('admin.password.update');
    Route::get('/companies', [AdminController::class, 'companies'])->name('companies');
    Route::get('/companies/{id}', [AdminController::class, 'showCompany'])->name('companies.show');
    Route::delete('/companies/{id}', [AdminController::class, 'destroyCompany'])->name('companies.destroy');
    Route::get('/lowongan', [AdminController::class, 'lowongan'])->name('lowongan.index');
    Route::get('/lowongan/{id}', [AdminController::class, 'showLowongan'])->name('lowongan.show');
    Route::delete('/lowongan/{id}', [AdminController::class, 'destroyLowongan'])->name('lowongan.destroy');
    Route::get('/events', [AdminController::class, 'events'])->name('events');
    Route::get('/events/create', fn() => view('admin.pages.event.create'))->name('events.create');
    Route::post('/events', [AdminController::class, 'storeEvent'])->name('events.store');
    Route::get('/events/{id}/edit', [AdminController::class, 'editEvent'])->name('events.edit');
    Route::patch('/events/{id}', [AdminController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{id}', [AdminController::class, 'destroyEvent'])->name('events.destroy');
    Route::get('/notifications/latest', [AdminController::class, 'notificationsLatest'])->name('admin.notifications.latest');
    Route::post('/verify-company', [AdminController::class, 'verifyCompany'])->name('admin.verify.company');
    Route::get('/audit-log', [AdminController::class, 'auditLog'])->name('audit-log.index');
});

Route::middleware(['auth.supabase', 'role:perusahaan'])->prefix('company')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('company.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('company.profile.update');
    Route::get('/password', [ProfileController::class, 'password'])->name('company.password');
    Route::post('/password', [ProfileController::class, 'updatePassword'])->name('company.password.update');

    Route::middleware('verified.company')->group(function () {
        Route::get('/overview', [OverviewController::class, 'index'])->name('overview');
        Route::get('/interviews/calendar', [InterviewController::class, 'calendar'])->name('interviews.calendar');

        Route::get('/jobs', [LowonganController::class, 'index'])->name('jobs');
        Route::get('/jobs/create', [LowonganController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [LowonganController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{id}', [LowonganController::class, 'show'])->name('jobs.show');
        Route::get('/jobs/{id}/edit', [LowonganController::class, 'edit'])->name('jobs.edit');
        Route::patch('/jobs/{id}', [LowonganController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{id}', [LowonganController::class, 'destroy'])->name('jobs.destroy');

        Route::get('/applicants', [LamaranController::class, 'index'])->name('applicants');
        Route::get('/applicants/export', [LamaranController::class, 'export'])->name('applicants.export');
        Route::get('/applicants/{id}/edit', [LamaranController::class, 'edit'])->name('applicants.edit');
        Route::delete('/applicants/{id}', [LamaranController::class, 'destroy'])->name('applicants.destroy');
        Route::patch('/applicants/{id}/status', [LamaranController::class, 'updateStatus'])->name('applicants.status');
        Route::patch('/applicants/{id}/notes', [LamaranController::class, 'updateNotes'])->name('applicants.notes');
        Route::post('/applicants/{id}/review-result-email', [LamaranController::class, 'sendReviewResultEmail'])->name('applicants.review-result-email');
        Route::post('/applicants/{id}/interview-result-email', [LamaranController::class, 'sendInterviewResultEmail'])->name('applicants.interview-result-email');
        Route::get('/applicants/{id}/berkas/{tipe}', [LamaranController::class, 'downloadBerkas'])->name('applicants.berkas')->where('tipe', 'cv|portofolio|surat_lamaran|transkip_nilai|pas_foto');

        Route::get('/notifications/latest', [NotificationController::class, 'latest'])->name('notifications.latest');
    });
});

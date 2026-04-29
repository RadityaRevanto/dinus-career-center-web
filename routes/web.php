<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Auth Route
Route::get('/login', function () { return view('auth.login'); });

// Company Dashboard UI Routes
Route::get('/company-register', function () { return view('auth.company-register'); });
Route::get('/company/jobs', function () { return view('company.jobs.index'); });
Route::get('/company/jobs/create', function () { return view('company.jobs.create'); });
Route::get('/company/applicants', function () { return view('company.applicants.index'); });

Route::get('/admin', function () { return view('admin.layouts.app'); });

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('admin.pages.dashboard'))->name('dashboard');
    Route::get('/companies', fn() => view('admin.pages.companies'))->name('companies');
    Route::get('/jobs', fn() => view('admin.pages.job_listings'))->name('job_listings');
    
    Route::get('/events', fn() => view('admin.pages.event.index'))->name('events');
    Route::get('/events/create', fn() => view('admin.pages.event.create'))->name('events.create');
});

Route::prefix('company')->group(function () {
    Route::get('/overview', fn() => view('company.pages.overview'))->name('overview');
    Route::get('/jobs', fn() => view('company.pages.jobs.index'))->name('jobs');
    Route::get('/jobs/show', fn() => view('company.pages.jobs.show'))->name('jobs.show');
    Route::get('/jobs/create', fn() => view('company.pages.jobs.create'))->name('jobs.create');
    Route::get('/jobs/edit', fn() => view('company.pages.jobs.edit'))->name('jobs.edit');
    
    Route::get('/applicants', fn() => view('company.pages.pelamar.index'))->name('applicants');
    Route::get('/applicants/show', fn() => view('company.pages.pelamar.show'))->name('applicants.show');
});
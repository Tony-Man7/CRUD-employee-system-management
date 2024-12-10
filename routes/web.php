<?php

use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceRecordController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\KanbanController;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Employee Routes
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Service Record Routes
    Route::get('/service-records', [ServiceRecordController::class, 'index'])->name('service-records');
    Route::get('/service-records/create', [ServiceRecordController::class, 'create'])->name('service-records.create');
    Route::post('/service-records', [ServiceRecordController::class, 'store'])->name('service-records.store');
    Route::get('/service-records/{id}', [ServiceRecordController::class, 'show'])->name('service-records.show');
    Route::get('/service-records/{id}/edit', [ServiceRecordController::class, 'edit'])->name('service-records.edit');
    Route::put('/service-records/{id}', [ServiceRecordController::class, 'update'])->name('service-records.update');
    Route::delete('/service-records/{id}', [ServiceRecordController::class, 'destroy'])->name('service-records.destroy');

    // Department Routes
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

    // Kanban Board Routes
    Route::get('/kanban-board', [KanbanController::class, 'index'])->name('kanban-board');


});

Route::middleware('guest')->group(function () {
    Route::inertia('/', 'LoginForm')->name('login');
    Route::inertia('/register', 'RegisterForm')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeProjectController;

Route::get('/', [EmployeeProjectController::class, 'index'])->name('employee-pairs');
Route::get('/table', [EmployeeProjectController::class, 'table'])->name('employee-table');
Route::post('/upload', [EmployeeProjectController::class, 'store'])->name('upload-file');

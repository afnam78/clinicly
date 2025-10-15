<?php

declare(strict_types=1);

use App\Livewire\Patients\CreatePatient;
use App\Livewire\Patients\EditPatient;
use App\Livewire\Patients\PatientsTable;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('pacientes', PatientsTable::class)->name('patients.table');
    Route::get('pacientes/crear', CreatePatient::class)->name('patients.create');
    Route::get('pacientes/editar/{patientId}', EditPatient::class)->name('patients.edit');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

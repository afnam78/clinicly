<?php

declare(strict_types=1);

use App\Livewire\Appointments\AppointmentsTable;
use App\Livewire\Appointments\CreateAppointment;
use App\Livewire\Appointments\EditAppointment;
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

    Route::get('citas', AppointmentsTable::class)->name('appointments.table');
    Route::get('citas/crear', CreateAppointment::class)->name('appointments.create');
    Route::get('citas/editar/{appointmentId}', EditAppointment::class)->name('appointments.edit');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

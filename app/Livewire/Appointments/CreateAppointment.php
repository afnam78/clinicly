<?php

declare(strict_types=1);

namespace App\Livewire\Appointments;

use App\Domain\Appointments\CreateAppointmentService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class CreateAppointment extends Component
{
    use Toastable;

    #[Validate('required|integer')]
    public ?int $selectedPatient = null;

    #[Validate('required|integer')]
    public ?int $selectedService = null;

    #[Validate('required|date|after:today')]
    public ?string $startAt = null;

    #[Validate('required|integer|min:5|max:720')]
    public ?int $duration = null;

    #[Validate('nullable|string|max:1000')]
    public ?string $notes = null;

    public int $specialistId;

    public int $clinicId;

    public function render()
    {
        return view('livewire.appointments.create-appointment', [
            'patients' => User::where('role', 'patient')
                ->where('clinic_id', $this->clinicId)
                ->get(),
            'services' => Service::where('clinic_id', $this->clinicId)
                ->get(),
        ]);
    }

    public function mount() : void
    {
        $this->clinicId = auth()->user()->clinic_id;
        $this->specialistId = auth()->user()->id;
    }

    public function save(CreateAppointmentService $service) : void
    {
        $this->validate();

        try {
            $service->execute(
                patientId: $this->selectedPatient,
                serviceId: $this->selectedService,
                startAt: Carbon::createFromFormat(config('date_format.appointment'), $this->startAt),
                duration: $this->duration,
                clinicId: $this->clinicId,
                notes: $this->notes,
                specialistId: $this->specialistId,
            );

            redirect()->route('appointments.table')->success('Cita creada exitosamente');
        } catch (\Exception $e) {
            $this->error('Error al crear la cita');
        }
    }
}

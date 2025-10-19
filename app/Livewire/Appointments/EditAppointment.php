<?php

declare(strict_types=1);

namespace App\Livewire\Appointments;

use App\Domain\Appointments\GetAppointmentService;
use App\Domain\Appointments\UpdateAppointmentService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class EditAppointment extends Component
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

    public int $appointmentId;

    public function render()
    {
        return view('livewire.appointments.edit-appointment', [
            'patients' => User::where('role', 'patient')
                ->where('clinic_id', $this->clinicId)
                ->get(),
            'services' => Service::where('clinic_id', $this->clinicId)
                ->get(),
        ]);
    }

    public function mount(int $appointmentId, GetAppointmentService $service) : void
    {
        $appointment = $service->execute($appointmentId);
        $this->appointmentId = $appointmentId;
        $this->clinicId = $appointment->clinic_id;
        $this->selectedPatient = $appointment->patient_id;
        $this->selectedService = $appointment->service_id;
        $this->startAt = $appointment->start_at->format(config('date_format.appointment'));
        $this->duration = $appointment->duration;
        $this->notes = $appointment->notes;
        $this->specialistId = $appointment->specialist_id;
    }

    public function save(UpdateAppointmentService $service) : void
    {
        $this->validate();

        try {
            $service->execute(
                id: $this->appointmentId,
                patientId: $this->selectedPatient,
                serviceId: $this->selectedService,
                startAt: Carbon::createFromFormat(config('date_format.appointment'), $this->startAt),
                duration: $this->duration,
                clinicId: $this->clinicId,
                specialistId: $this->specialistId,
                notes: $this->notes,
            );

            redirect()->route('appointments.table')->success('Cita actualizada exitosamente');
        } catch (\Exception $e) {
            $this->error('Error al crear la cita');
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\Appointments;

use App\Domain\Enums\RoleEnum;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CreateAppointmentService
{
    public function execute(
        int $patientId,
        int $serviceId,
        Carbon $startAt,
        int $duration,
        int $clinicId,
        int $specialistId,
        ?string $notes = null,
    ) : void {

        try {
            $this->validateStartAt($startAt);
            $this->validateSpecialist($specialistId, $clinicId);
            $this->validatePatientExists($patientId, $clinicId);
            $this->validateServiceExists($serviceId, $clinicId);

            Appointment::create([
                'patient_id' => $patientId,
                'service_id' => $serviceId,
                'clinic_id' => $clinicId,
                'start_at' => $startAt,
                'end_at' => $startAt->copy()->addMinutes($duration),
                'duration' => $duration,
                'notes' => $notes,
                'specialist_id' => $specialistId,
            ]);
        } catch (\Exception $e) {
            Log::error('Error al crear la cita', [$e->getMessage()]);

            throw $e;
        }
    }

    private function validateStartAt(Carbon $startAt) : void
    {
        if ($startAt->isPast()) {
            throw new \Exception('La fecha de inicio de la cita no puede ser en el pasado');
        }
    }

    private function validateSpecialist(int $specialistId, int $clinicId) : void
    {
        if (User::where('id', $specialistId)
            ->where('role', RoleEnum::SPECIALIST->value)
            ->where('clinic_id', $clinicId)
            ->doesntExist()) {
            throw new \Exception('El especialista no existe');
        }
    }

    private function validatePatientExists(int $patientId, int $clinicId) : void
    {
        if (User::where('id', $patientId)
            ->where('role', RoleEnum::PATIENT->value)
            ->where('clinic_id', $clinicId)
            ->doesntExist()) {
            throw new \Exception('El paciente no existe');
        }
    }

    private function validateServiceExists(int $serviceId, int $clinicId) : void
    {
        if (Service::where('id', $serviceId)
            ->where('clinic_id', $clinicId)
            ->doesntExist()) {
            throw new \Exception('El servicio no existe');
        }
    }
}

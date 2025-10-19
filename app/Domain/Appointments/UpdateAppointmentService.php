<?php

declare(strict_types=1);

namespace App\Domain\Appointments;

use App\Models\Appointment;
use Illuminate\Support\Carbon;

class UpdateAppointmentService
{
    public function execute(
        int $id,
        int $patientId,
        int $serviceId,
        Carbon $startAt,
        int $duration,
        int $clinicId,
        int $specialistId,
        ?string $notes = null,
    ) : void {
        $appointment = Appointment::where('id', $id)
            ->where('clinic_id', $clinicId)
            ->where('specialist_id', $specialistId)
            ->firstOrFail();

        $appointment->update([
            'patient_id' => $patientId,
            'service_id' => $serviceId,
            'start_at' => $startAt,
            'duration' => $duration,
            'notes' => $notes,
        ]);
    }
}

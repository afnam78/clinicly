<?php

declare(strict_types=1);

namespace App\Domain\Appointments;

use App\Models\Appointment;

class DeleteAppointmentService
{
    public function execute(int $id, int $clinicId, int $specialistId) : void
    {
        Appointment::where('id', $id)
            ->where('clinic_id', $clinicId)
            ->where('specialist_id', $specialistId)
            ->firstOrFail()
            ->delete();
    }
}

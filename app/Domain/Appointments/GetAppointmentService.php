<?php

declare(strict_types=1);

namespace App\Domain\Appointments;

use App\Models\Appointment;

class GetAppointmentService
{
    public function execute(int $id) : Appointment
    {
        return Appointment::where('id', $id)
            ->where('clinic_id', auth()->user()->clinic_id)
            ->firstOrFail();
    }
}

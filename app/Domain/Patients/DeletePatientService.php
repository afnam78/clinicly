<?php

declare(strict_types=1);

namespace App\Domain\Patients;

use App\Domain\Enums\RoleEnum;
use App\Models\User;

class DeletePatientService
{
    public function execute(int $id, int $clinicId) : void
    {
        User::where('id', $id)
            ->where('clinic_id', $clinicId)
            ->where('role', RoleEnum::PATIENT->value)
            ->delete();
    }
}

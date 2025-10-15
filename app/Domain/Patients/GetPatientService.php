<?php

declare(strict_types=1);

namespace App\Domain\Patients;

use App\Domain\Enums\RoleEnum;
use App\Models\User;

class GetPatientService
{
    public function execute(
        int $id
    ) : User {

        return User::select('id', 'name', 'last_name', 'phone', 'email', 'nif', 'gender', 'birth_date')
            ->where('role', RoleEnum::PATIENT->value)
            ->where('id', $id)
            ->where('clinic_id', auth()->user()->clinic_id)
            ->firstOrFail();
    }
}

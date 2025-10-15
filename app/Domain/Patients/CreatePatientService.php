<?php

declare(strict_types=1);

namespace App\Domain\Patients;

use App\Domain\Enums\GenderEnum;
use App\Domain\Enums\RoleEnum;
use App\Domain\Exceptions\FutureDateException;
use App\Domain\Exceptions\PatientAlreadyExists;
use App\Models\User;
use Illuminate\Support\Carbon;

class CreatePatientService
{
    public function execute(
        string $name,
        string $lastName,
        string $phone,
        string $email,
        string $nif,
        ?Carbon $birthDate = null,
        ?GenderEnum $gender = null,
    ) : void {

        if ($birthDate?->isFuture()) {
            throw new FutureDateException;
        }

        $clinicId = auth()->user()->clinic_id;

        $existPatientInThisClinic = User::where('clinic_id', $clinicId)
            ->where('nif', $nif)
            ->where('role', RoleEnum::PATIENT->value)
            ->exists();

        if ($existPatientInThisClinic) {
            throw new PatientAlreadyExists;
        }

        User::create([
            'name' => $name,
            'last_name' => $lastName,
            'phone' => $phone,
            'email' => $email,
            'nif' => $nif,
            'birth_date' => $birthDate,
            'gender' => $gender?->value,
            'role' => RoleEnum::PATIENT->value,
            'password' => bcrypt(fake()->password(12)),
            'clinic_id' => $clinicId,
        ]);
    }
}

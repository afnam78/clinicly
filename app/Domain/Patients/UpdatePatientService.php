<?php

declare(strict_types=1);

namespace App\Domain\Patients;

use App\Domain\Enums\GenderEnum;
use App\Domain\Exceptions\FutureDateException;
use Illuminate\Support\Carbon;

class UpdatePatientService
{
    public function __construct(private readonly GetPatientService $getPatientService) {}

    public function execute(
        int $id,
        string $name,
        string $lastName,
        string $phone,
        string $email,
        string $nif,
        ?Carbon $birthDate = null,
        ?GenderEnum $gender = null,
    ) : void {

        $patient = $this->getPatientService->execute($id);

        if ($birthDate?->isFuture()) {
            throw new FutureDateException;
        }

        $patient->update([
            'name' => $name,
            'last_name' => $lastName,
            'phone' => $phone,
            'email' => $email,
            'nif' => $nif,
            'birth_date' => $birthDate,
            'gender' => $gender?->value,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\Enums;

enum RoleEnum : string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case SPECIALIST = 'specialist';
    case RECEPTIONIST = 'receptionist';
    case PATIENT = 'patient';

    public function label() : string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Administrador',
            self::SPECIALIST => 'Especialista',
            self::RECEPTIONIST => 'Recepcionista',
            self::PATIENT => 'Paciente',
        };
    }
}

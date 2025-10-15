<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

class FutureDateException extends \Exception
{
    public function __construct()
    {
        parent::__construct('La fecha es del futuro.');
    }
}

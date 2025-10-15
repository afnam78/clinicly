<?php

declare(strict_types=1);

namespace App\Livewire\Patients;

use App\Domain\Enums\GenderEnum;
use App\Domain\Exceptions\FutureDateException;
use App\Domain\Exceptions\PatientAlreadyExists;
use App\Domain\Patients\CreatePatientService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class CreatePatient extends Component
{
    use Toastable;

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string|max:255')]
    public $lastname = '';

    #[Validate('required|string|max:255')]
    public $phone = '';

    #[Validate('required|string|email|max:255')]
    public $email = '';

    #[Validate('required|string|max:255')]
    public $nif = '';

    #[Validate('required|date')]
    public ?Carbon $birth_date = null;

    #[Validate('nullable')]
    public ?GenderEnum $gender = null;

    public function render()
    {
        return view('livewire.patients.create-patient');
    }

    public function store(CreatePatientService $service) : void
    {
        $this->validate();

        try {
            $service->execute(
                name: $this->name,
                lastName: $this->lastname,
                phone: $this->phone,
                email: $this->email,
                nif: $this->nif,
                birthDate: $this->birth_date,
                gender: $this->gender,
            );

            redirect()->route('patients.table')->success('Paciente creado exitosamente');
        } catch (PatientAlreadyExists|FutureDateException $exception) {
            $this->error($exception->getMessage());
        } catch (\Exception $e) {
            Log::error('Error al crear el paciente', [$e->getMessage()]);

            $this->error('Error al crear el paciente');
        }
    }
}

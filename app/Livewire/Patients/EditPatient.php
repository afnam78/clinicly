<?php

declare(strict_types=1);

namespace App\Livewire\Patients;

use App\Domain\Enums\GenderEnum;
use App\Domain\Patients\GetPatientService;
use App\Domain\Patients\UpdatePatientService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class EditPatient extends Component
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

    public int $patientId;

    public function render()
    {
        return view('livewire.patients.edit-patient');
    }

    public function mount(int $patientId, GetPatientService $service) : void
    {
        $patient = $service->execute($patientId);

        $this->patientId = $patientId;
        $this->name = $patient->name;
        $this->lastname = $patient->last_name;
        $this->phone = $patient->phone;
        $this->email = $patient->email;
        $this->nif = $patient->nif;
        $this->birth_date = $patient->birth_date;
        $this->gender = $patient->gender;
    }

    public function store(UpdatePatientService $service) : void
    {
        $this->validate();

        try {
            $service->execute(
                id: $this->patientId,
                name: $this->name,
                lastName: $this->lastname,
                phone: $this->phone,
                email: $this->email,
                nif: $this->nif,
                birthDate: $this->birth_date,
                gender: $this->gender,
            );

            redirect()->route('patients.table')->success('Paciente actualizado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar el paciente', [$e->getMessage()]);

            $this->error('Error al actualizar el paciente');
        }
    }
}

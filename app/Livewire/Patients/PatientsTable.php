<?php

declare(strict_types=1);

namespace App\Livewire\Patients;

use App\Domain\Enums\RoleEnum;
use App\Domain\Patients\DeletePatientService;
use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class PatientsTable extends Component
{
    use Toastable;

    public function render()
    {
        return view('livewire.patients.patients-table', [
            'patients' => User::where('role', RoleEnum::PATIENT->value)->paginate(10),
        ]);
    }

    public function delete(int $id, DeletePatientService $service) : void
    {
        try {
            $service->execute($id, auth()->user()->clinic_id);
            $this->success('Paciente eliminado correctamente');
        } catch (\Exception $e) {
            $this->error('Error al eliminar el paciente');
        }
    }
}

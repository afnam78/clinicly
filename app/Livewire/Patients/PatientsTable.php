<?php

declare(strict_types=1);

namespace App\Livewire\Patients;

use App\Domain\Enums\RoleEnum;
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

    public function delete(int $id) : void
    {
        try {
            User::find($id)?->delete();
        } catch (\Exception $e) {
            $this->error('Error al eliminar el paciente');
        }
    }
}

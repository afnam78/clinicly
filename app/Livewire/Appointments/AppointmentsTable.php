<?php

declare(strict_types=1);

namespace App\Livewire\Appointments;

use App\Domain\Appointments\DeleteAppointmentService;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

class AppointmentsTable extends Component
{
    use Toastable, WithPagination;

    public function render()
    {
        return view('livewire.appointments.appointments-table', [
            'appointments' => Appointment::where('clinic_id', auth()->user()->clinic_id)->paginate(10),
        ]);
    }

    public function delete(int $id, DeleteAppointmentService $service) : void
    {
        try {
            $service->execute($id, auth()->user()->clinic_id, auth()->user()->id);

            $this->success('Cita eliminada correctamente');
        } catch (\Exception $e) {
            $this->error('Error al eliminar la cita');

            Log::error('Error al eliminar la cita', [$e->getMessage()]);
        }
    }
}

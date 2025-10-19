<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Citas') }}
        </h2>
    </x-slot>

    <div class="flex justify-end">
        <a href="{{ route('appointments.create') }}">
            <x-primary-button >Crear cita</x-primary-button>
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Duración estimada
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Paciente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Servicio
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('appointments.edit', ['appointmentId' => $appointment->id]) }}">
                                Editar
                            </a>
                            <x-danger-button wire:confirm="¿Estás seguro de realizar esta acción?" wire:click="delete({{ $appointment->id }})" class="ml-2">
                                Eliminar
                            </x-danger-button>
                        </th>
                        <td class="px-6 py-4">
                            {{ $appointment->start_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $appointment->duration }} minutos
                        </td>
                        <td class="px-6 py-4">
                            {{ $appointment->patient->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $appointment->service->name }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="mt-5">
        {{ $appointments->links() }}
    </div>
</div>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>

    <div class="flex justify-end">
        <a href="{{ route('patients.create') }}">
            <x-primary-button >Crear paciente</x-primary-button>
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
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Teléfono
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($patients as $patient)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('patients.edit', ['patientId' => $patient->id]) }}">
                                Editar
                            </a>
                            <x-danger-button wire:confirm="¿Estás seguro de realizar esta acción?" wire:click="delete({{ $patient->id }})" class="ml-2">
                                Eliminar
                            </x-danger-button>
                        </th>
                        <td class="px-6 py-4">
                            {{ $patient->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->email }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agendar cita') }}
        </h2>
    </x-slot>
    <form wire:submit="save">
        <div class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2">
                    <label for="selectPatient">Seleccionar paciente</label>
                    <x-select-input id="selectPatient" wire:model="selectedPatient">
                        <option value="">Seleccionar</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name . ' ' . $patient->nif}}</option>
                        @endforeach
                    </x-select-input>
                </div>
                <div class="col-span-2">
                    <label for="selectService">Select service</label>
                    <x-select-input id="selectService" wire:model="selectedService">
                        <option value="">Seleccionar</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name}}</option>
                        @endforeach
                    </x-select-input>
                </div>

            </div>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2" wire:ignore>
                    <x-input-label id="start_at">Fecha y hora</x-input-label>
                    <input type="text" wire:model="startAt" id="start_at" class="w-full border-gray-300 rounded-md"
                           placeholder="Selecciona fecha y hora">
                </div>
                <div class="col-span-2" >
                    <x-input-label id="start_at">Duración estimada</x-input-label>
                    <x-text-input type="number" class="w-full" min="5" step="5" max="720" placeholder="En minutos" wire:model="duration"></x-text-input>
                </div>
            </div>
            <div class="w-full">
                <x-input-label id="notes">Observaciones</x-input-label>
                <textarea wire:model="notes" id="notes" class="w-full border-gray-300 rounded-md">

                </textarea>
            </div>
        </div>
        <div class="flex justify-between mt-5">
            <a href="{{ route('appointments.table') }}">
                <x-secondary-button>
                    {{ __('Cancelar') }}
                </x-secondary-button>
            </a>
            <x-primary-button>
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</div>

@push('scripts')

    <script type="text/javascript">
        document.addEventListener('livewire:initialized', function () {
            flatpickr("#start_at", {
                enableTime: true,
                dateFormat: "{{config('date_format.appointment')}}",
                time_24hr: true,
                minDate: "today",
            });
        })
    </script>
@endpush

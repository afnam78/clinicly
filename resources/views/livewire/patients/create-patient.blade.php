@php use App\Domain\Enums\GenderEnum; @endphp
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear paciente') }}
        </h2>
    </x-slot>

    <form wire:submit="store">
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-2">
                <div class="w-full">
                    <x-input-label for="name">Nombre*</x-input-label>
                    <x-text-input type="text" id="name" class="w-full" wire:model="name"></x-text-input>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full">
                    <x-input-label for="lastname">Apellidos</x-input-label>
                    <x-text-input type="text" id="lastname" class="w-full" wire:model="lastname"></x-text-input>
                    @error('lastname') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div class="w-full">
                    <x-input-label for="phone">Teléfono*</x-input-label>
                    <x-text-input type="text" id="phone" class="w-full" wire:model="phone"></x-text-input>
                    @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full">
                    <x-input-label for="phone">Email*</x-input-label>
                    <x-text-input type="email" id="phone" class="w-full" wire:model="email"></x-text-input>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid grid-cols-4 gap-2">
                <div class="w-full col-span-2">
                    <x-input-label for="nif">NIF*</x-input-label>
                    <x-text-input type="text" id="nif" class="w-full" wire:model="nif"></x-text-input>
                    @error('nif') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full col-span-1">
                    <x-input-label for="birth_date">Fecha de nacimiento*</x-input-label>
                    <x-text-input type="date" id="birth_date" class="w-full" wire:model="birth_date"></x-text-input>
                    @error('birth_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="w-full col-span-1">
                    <x-input-label for="gender">Género</x-input-label>
                    <select name="gender" id="gender" class="w-full" wire:model="gender">
                        <option value="" selected>Selecciona</option>
                        @foreach (GenderEnum::cases() as $gender)
                            <option value="{{ $gender->value }}">{{ $gender->name }}</option>
                        @endforeach
                    </select>
                    @error('gender') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="mt-5 flex justify-between">
            <a href="{{route('patients.table')}}">
                <x-secondary-button>
                    Cancelar
                </x-secondary-button>
            </a>
            <x-primary-button>
                Crear
            </x-primary-button>
        </div>
    </form>
</div>

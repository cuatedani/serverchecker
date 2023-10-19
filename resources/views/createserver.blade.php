<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Servidor') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('server.create') }}">
            @csrf

            <!-- Nombre del Servidor -->
            <div>
                <x-input-label for="name" :value="__('Nombre del Servidor:')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Campos de la IP -->
            <div class="mt-4 grid grid-cols-4 gap-4">
                <x-input-label :value="'IP del Servidor: '" />
            </div>
            <div class="mt-4 flex items-center">

                <x-text-input class="mr-2" type="number" name="ip_part1" :value="old('ip_part1')" min="1"
                    max="255" required />
                <x-input-label :value="'.'" />

                <x-text-input class="mr-2" type="number" name="ip_part2" :value="old('ip_part2')" min="0"
                    max="255" required />
                <x-input-label :value="'.'" />

                <x-text-input class="mr-2" type="number" name="ip_part3" :value="old('ip_part3')" min="0"
                    max="255" required />
                <x-input-label :value="'.'" />

                <x-text-input class="mr-2" type="number" name="ip_part4" :value="old('ip_part4')" min="0"
                    max="255" required />

            </div>

            <!-- Errores de la IP-->
            <div class="mt-2">
                <x-input-error :messages="$errors->get('ip_part1')" class="ml-2" />
                <x-input-error :messages="$errors->get('ip_part2')" class="ml-2" />
                <x-input-error :messages="$errors->get('ip_part3')" class="ml-2" />
                <x-input-error :messages="$errors->get('ip_part4')" class="ml-2" />
            </div>

            <!-- Descripción -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Descripción:')" />
                <textarea id="description" class="block mt-1 w-full" name="description" :value="old('description')" rows="3"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-danger-button class="ml-4"><a href="{{ route('servers.show') }}"
                        class="btn btn-warning mr-2">{{ __('Cancelar') }}</a></x-danger-button>
                <x-primary-button class="ml-4">
                    {{ __('Añadir') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>

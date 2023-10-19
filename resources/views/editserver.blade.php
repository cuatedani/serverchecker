<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Servidor') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('server.update', $server->id) }}">
            @csrf
            @method('PUT')

            <!-- Nombre del Servidor -->
            <div>
                <x-input-label for="name" :value="__('Nombre del Servidor:')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$server->servername"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Campos de la IP -->
            <div class="mt-4 grid grid-cols-4 gap-4">
                <x-input-label :value="'IP del Servidor: '" />
            </div>
            <div class="mt-4 flex items-center">
                @php
                    $ip_parts = explode('.', $server->serverip);
                @endphp

                <x-text-input class="mr-2" type="number" name="ip_part1" :value="$ip_parts[0]" min="1"
                    max="255" required />
                <x-input-label :value="'.'" />

                <x-text-input class="mr-2" type="number" name="ip_part2" :value="$ip_parts[1]" min="0"
                    max="255" required />
                <x-input-label :value="'.'" />

                <x-text-input class="mr-2" type="number" name="ip_part3" :value="$ip_parts[2]" min="0"
                    max="255" required />
                <x-input-label :value="'.'" />

                <x-text-input class="mr-2" type="number" name="ip_part4" :value="$ip_parts[3]" min="0"
                    max="255" required />

            </div>

            <!-- Errores de la IP-->
            <div class="mt-2">
                @for ($i = 1; $i <= 4; $i++)
                    <x-input-error :messages="$errors->get('ip_part' . $i)" class="ml-2" />
                @endfor
            </div>

            <!-- Descripción -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Descripción:')" />
                <textarea id="description" class="block mt-1 w-full" name="description" rows="3">{{ $server->description }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-end mt-4">
                <x-danger-button class="ml-4"><a href="{{ route('servers.show') }}"
                        class="btn btn-warning mr-2">{{ __('Cancelar') }}</a></x-danger-button>
                <x-primary-button class="ml-4">
                    {{ __('Editar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Servidores') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end space-x-4 mb-4">
            <div class="ml-4">
                <x-primary-button><a href="{{ url('/server/add') }}"
                        class="btn btn-primary">{{ __('Añadir') }}</a></x-primary-button>
                <x-primary-button>{{ __('Temporizador') }}</x-primary-button>
            </div>
        </div>

        @forelse ($servers as $server)
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-4">
                <div class="p-4 sm:p-8">
                    <table class="table-auto w-full">
                        <tr class="text-secondary">
                            <th class="py-2 text-center">Nombre</th>
                            <th class="py-2 text-center">Dirección IP</th>
                            <th class="py-2 text-center">Acciones</th>
                        </tr>
                        <tr>
                            <td class="py-2 font-bold text-center">{{ $server->servername }}</td>
                            <td class="py-2 text-center">{{ $server->serverip }}</td>
                            <td class="py-2 text-center flex justify-center items-center">
                                <x-secondary-button class="mr-2">
                                    <a href="{{ route('server.edit', ['id' => $server->id]) }}" class="btn btn-primary">
                                        {{ __('Editar') }}
                                    </a>
                                </x-secondary-button>

                                <form action="{{ route('server.destroy', $server->id) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este servidor?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit" class="text-red-500 hover:text-red-700 ml-2">
                                        {{ __('Eliminar') }}
                                    </x-danger-button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @empty
            <p>No hay servidores disponibles</p>
        @endforelse

    </div>
</x-app-layout>

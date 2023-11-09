@extends('layouts.app')

@section('content')
    <x-slot name="header" class="bg-white">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Servidores') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end space-x-4 mb-4">
            <div class="ml-4">
                <button>
                    <a href="{{ route('server.create') }}" class="btn-primary">{{ __('Añadir') }}</a>
                </button>
                <button id="btn-check-one">{{ __('Check') }}</button>
                <button id="btn-check-all">{{ __('Intervalo  V') }}</button>
            </div>
        </div>

        @forelse ($servers as $server)
            @if ($server->status === 'Desconocido')
                <div class="bg-white  shadow sm:rounded-lg mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $server->servername }}</h5>
                            <p class="card-text">{{ $server->status }} </p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-question" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14.5 18.004h-7.843c-2.572 -.004 -4.657 -2.011 -4.657 -4.487c0 -2.475 2.085 -4.482 4.657 -4.482c.393 -1.762 1.794 -3.2 3.675 -3.773c1.88 -.572 3.956 -.193 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99" />
                                <path d="M19 22v.01" />
                                <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                            </svg>
                            <a href="#" class="btn btn-primary">Más info</a>
                        </div>
                    </div>
                </div>
            @else
                @if ($server->status === 'Activo')
                    <div class="bg-white  shadow sm:rounded-lg mb-4">
                        <div class="p-4 sm:p-8">
                            <table class="table-auto w-full">
                                <tr class="text-secondary">
                                    <th class="py-2 text-center">Nombre</th>
                                    <th class="py-2 text-center">Dirección IP</th>
                                    <th class="py-2 text-center">Descripción</th>
                                    <th class="py-2 text-center">Estado</th>
                                    <th class="py-2 text-center">Tiempo de Estado</th>
                                    <th class="py-2 text-center">Última Comprobación</th>
                                    <th class="py-2 text-center">Acciones</th>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold text-center">{{ $server->servername }}</td>
                                    <td class="py-2 text-center">{{ $server->serverip }}</td>
                                    <td class="py-2 text-center">{{ $server->description }}</td>
                                    <td class="py-2 text-center">{{ $server->status }} <svg
                                            xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wifi"
                                            width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="#00b341" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 18l.01 0" />
                                            <path d="M9.172 15.172a4 4 0 0 1 5.656 0" />
                                            <path d="M6.343 12.343a8 8 0 0 1 11.314 0" />
                                            <path d="M3.515 9.515c4.686 -4.687 12.284 -4.687 17 0" />
                                        </svg></td>
                                    <td class="py-2 text-center">{{ $server->statustime }}</td>
                                    <td class="py-2 text-center">{{ $server->lastcheck }}</td>
                                    <td class="py-2 text-center flex justify-center items-center">
                                        <button class="mr-2 btn-edit" data-server-id="{{ $server->id }}">
                                            {{ __('Editar') }}
                                        </button>

                                        <form id="btndelete{{ $server->id }}"
                                            action="{{ route('server.destroy', $server->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 ml-2 btn-delete" data-server-id="{{ $server->id }}">
                                                {{ __('Eliminar') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="bg-white  shadow sm:rounded-lg mb-4">
                        <div class="p-4 sm:p-8">
                            <table class="table-auto w-full">
                                <tr class="text-secondary">
                                    <th class="py-2 text-center">Nombre</th>
                                    <th class="py-2 text-center">Dirección IP</th>
                                    <th class="py-2 text-center">Descripción</th>
                                    <th class="py-2 text-center">Estado</th>
                                    <th class="py-2 text-center">Tiempo de Estado</th>
                                    <th class="py-2 text-center">Última Comprobación</th>
                                    <th class="py-2 text-center">Última Respuesta</th>
                                    <th class="py-2 text-center">Acciones</th>
                                </tr>
                                <tr>
                                    <td class="py-2 font-bold text-center">{{ $server->servername }}</td>
                                    <td class="py-2 text-center">{{ $server->serverip }}</td>
                                    <td class="py-2 text-center">{{ $server->description }}</td>
                                    <td class="py-2 text-center">{{ $server->status }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wifi-off" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 18l.01 0" />
                                            <path d="M9.172 15.172a4 4 0 0 1 5.656 0" />
                                            <path d="M6.343 12.343a7.963 7.963 0 0 1 3.864 -2.14m4.163 .155a7.965 7.965 0 0 1 3.287 2" />
                                            <path d="M3.515 9.515a12 12 0 0 1 3.544 -2.455m3.101 -.92a12 12 0 0 1 10.325 3.374" />
                                            <path d="M3 3l18 18" />
                                          </svg>
                                    </td>
                                    <td class="py-2 text-center">{{ $server->statustime }}</td>
                                    <td class="py-2 text-center">{{ $server->lastcheck }}</td>
                                    <td class="py-2 text-center">{{ $server->lastresponse }}</td>
                                    <td class="py-2 text-center flex justify-center items-center">
                                        <x-secondary-button class="mr-2 btn-edit" data-server-id="{{ $server->id }}">
                                            {{ __('Editar') }}
                                        </x-secondary-button>

                                        <form id="btndelete{{ $server->id }}"
                                            action="{{ route('server.destroy', $server->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 ml-2 btn-delete" data-server-id="{{ $server->id }}">
                                                {{ __('Eliminar') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                @endif
            @endif
        @empty
            <p class="font-semibold text-xl text-gray-800 leading-tight">No hay servidores
                disponibles</p>
        @endforelse
    </div>

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="module" src="{{ asset('js/serverdelete.js') }}"></script>
        <script type="module" src="{{ asset('js/serveredit.js') }}"></script>
        <script type="module" src="{{ asset('js/servercheckone.js') }}"></script>
    @endsection
@endsection

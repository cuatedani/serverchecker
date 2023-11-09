@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="text-center mb-3">
            <button class="btn btn-primary btn-add">{{ __('Añadir') }}</button>
            <button class="btn btn-primary" id="btn-check-all">{{ __('Check') }}</button>
            <button class="btn btn-primary" id="btn-ser-interval">{{ __('Intervalo  V') }}</button>
        </div>
        <div class="row mx-4 mb-4">
            @forelse ($servers as $server)
                @if ($server->status === 'Activo')
                    <div class="col-md-4 mb-3"> <!-- Mostrar 3 tarjetas por fila en dispositivos de escritorio -->
                        <div class="card p-3">
                            <div class="row" style="text-align: center;">
                                <h5 class="card-title"><strong>{{ $server->servername }}</strong></h5>
                            </div>
                            <div class= "m-0 col alert alert-success" role="alert" style="text-align: center;">
                                <strong>ESTE SERVIDOR ESTA ACTIVO</strong>
                            </div>
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionFlushExample-{{ $server->id }}">
                                    <div class="accordion-item">
                                        <div id="flush-collapseOne-{{ $server->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample-{{ $server->id }}">
                                            <div class="accordion-body">
                                                <h5 class="text-center"><strong>INFORMACIÓN </strong></h5>
                                                <p class="card-text"><strong>Dirección Ip:
                                                        {{ $server->serverip }}</strong></p>
                                                <p class="card-text"><strong>Tiempo en Estado:
                                                        {{ $server->statustime }}</strong></p>
                                                <p class="cart-text"><strong>Ultima Revisión:
                                                        {{ $server->lastcheck }}</strong></p>
                                                <p class="card-text"><strong>Inicio de Estado:
                                                        {{ $server->lastresponse }}</strong></p>
                                                <p class="card-text"><strong>Descripción:
                                                        {{ $server->description }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-lg btn-outline-primary btn-checkone"
                                    data-server-id="{{ $server->id }}"><i class="bi bi-arrow-repeat fa-10x"></i></button>
                                <button class="btn btn-lg btn-outline-info" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne-{{ $server->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne-{{ $server->id }}"><i class="bi bi-info-lg"></i></button>

                                <button class="btn btn-lg btn-outline-warning btn-edit"
                                    data-server-id="{{ $server->id }}"><i class="bi bi-pencil"></i></button>
                                <form id="btndelete{{ $server->id }}"
                                    action="{{ route('server.destroy', $server->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-lg btn-outline-danger btn-delete"
                                        data-server-id="{{ $server->id }}"><i class="bi bi-trash3"></i></button>
                                </form>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-4 mb-3"> <!-- Mostrar 3 tarjetas por fila en dispositivos de escritorio -->
                        <div class="card p-3">
                            <div class="row" style="text-align: center;">
                                <h5 class="card-title"><strong>{{ $server->servername }}</strong></h5>
                            </div>
                            <div class= "m-0 col alert alert-danger" role="alert" style="text-align: center;">
                                <strong>ESTE SERVIDOR ESTA INACTIVO</strong>
                            </div>
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionFlushExample-{{ $server->id }}">
                                    <div class="accordion-item">
                                        <div id="flush-collapseOne-{{ $server->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample-{{ $server->id }}">
                                            <div class="accordion-body">
                                                <h5 class="text-center"><strong>INFORMACIÓN </strong></h5>
                                                <p class="card-text"><strong>Dirección Ip:
                                                        {{ $server->serverip }}</strong></p>
                                                <p class="card-text"><strong>Tiempo en Estado:
                                                        {{ $server->statustime }}</strong></p>
                                                <p class="cart-text"><strong>Ultima Revisión:
                                                        {{ $server->lastcheck }}</strong></p>
                                                <p class="card-text"><strong>Inicio de Estado:
                                                        {{ $server->lastresponse }}</strong></p>
                                                <p class="card-text"><strong>Descripción:
                                                        {{ $server->description }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-lg btn-outline-primary btn-checkone"
                                    data-server-id="{{ $server->id }}"><i class="bi bi-arrow-repeat fa-10x"></i></button>

                                <button class="btn btn-lg btn-outline-info" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne-{{ $server->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne-{{ $server->id }}"><i class="bi bi-info-lg"></i></button>

                                <button class="btn btn-lg btn-outline-warning btn-edit"
                                    data-server-id="{{ $server->id }}"><i class="bi bi-pencil"></i></button>

                                <form id="btndelete{{ $server->id }}"
                                    action="{{ route('server.destroy', $server->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-lg btn-outline-danger btn-delete"
                                        data-server-id="{{ $server->id }}"><i class="bi bi-trash3"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-center">No hay servidores disponibles</p>
            @endforelse
        </div>
    </div>


    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="module" src="{{ asset('js/serverdelete.js') }}"></script>
        <script type="module" src="{{ asset('js/serveredit.js') }}"></script>
        <script type="module" src="{{ asset('js/serveradd.js') }}"></script>
        <script type="module" src="{{ asset('js/servercheckone.js') }}"></script>
        <script type="module" src="{{ asset('js/servercheckall.js') }}"></script>
    @endsection
@endsection

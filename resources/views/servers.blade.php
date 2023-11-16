@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="text-center mb-3 " role="toolbar">
            <button class="btn btn-primary btn-add">{{ __('Añadir') }}</button>
            <button class="btn btn-primary" id="btn-check-all">
                <span class="spinner-border spinner-border-sm" id="spn-check-all" aria-hidden="true" hidden="true"></span>
                <span class="button-text">Check</span></button>
        </div>
        <div class="row mx-4 mb-4">
            @forelse ($servers as $server)
                @if ($server->status === 'Activo')
                    <div class="col-md-4 mb-3"> <!-- Mostrar 3 tarjetas por fila en dispositivos de escritorio -->
                        <div class="card  p-3 elemento-servidor" id="card-{{ $server->id }}">
                            <div class="row" style="text-align: center;">
                                <h5 class="card-title server-name"><strong>{{ $server->servername }}</strong></h5>
                            </div>
                            <div class= "m-0 col alert alert-success" role="alert" id="div-estatus-{{ $server->id }}"
                                style="text-align: center;">
                                <strong class="text-uppercase"id="estatus-{{ $server->id }}">ESTE SERVIDOR ESTA
                                    {{ $server->status }}</strong>
                            </div>
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionFlushExample-{{ $server->id }}">
                                    <div class="accordion-item">
                                        <div id="flush-collapseOne-{{ $server->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample-{{ $server->id }}">
                                            <div class="accordion-body">
                                                <h5 class="text-center"><strong>INFORMACIÓN </strong></h5>
                                                <p class="card-text"><strong id="info1-{{ $server->id }}">Dirección Ip:
                                                        {{ $server->serverip }}</strong></p>
                                                <p class="card-text"><strong id="info2-{{ $server->id }}">Tiempo en
                                                        Estado:
                                                        {{ $server->statustime }}</strong></p>
                                                <p class="cart-text"><strong id="info3-{{ $server->id }}">Ultima
                                                        Revisión:
                                                        {{ $server->lastcheck }}</strong></p>
                                                <p class="card-text"><strong id="info4-{{ $server->id }}">Inicio de
                                                        Estado:
                                                        {{ $server->lastresponse }}</strong></p>
                                                <p class="card-text"><strong id="info5-{{ $server->id }}">Descripción:
                                                        {{ $server->description }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-lg btn-outline-primary btn-checkone"
                                    data-server-id="{{ $server->id }}">
                                    <i class="bi bi-arrow-repeat fa-10x button-icon" id="icon-check-one-{{ $server->id }}"></i>
                                    <span class="spinner-border spinner-border-sm button-loading"
                                        id="spn-check-one-{{ $server->id }}" aria-hidden="true" hidden="true"></span>
                                </button>
                                <button class="btn btn-lg btn-outline-info" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne-{{ $server->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne-{{ $server->id }}">
                                    <i class="bi bi-eye-slash"></i>
                                </button>

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
                        <div class="card p-3 elemento-servidor" id="card-{{ $server->id }}">
                            <div class="row" style="text-align: center;">
                                <h5 class="card-title server-name"><strong>{{ $server->servername }}</strong></h5>
                            </div>
                            <div class= "m-0 col alert alert-danger" id="div-estatus-{{ $server->id }}" role="alert"
                                style="text-align: center;">
                                <strong class="text-uppercase" id="estatus-{{ $server->id }}">ESTE SERVIDOR ESTA
                                    {{ $server->status }}</strong>
                            </div>
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionFlushExample-{{ $server->id }}">
                                    <div class="accordion-item">
                                        <div id="flush-collapseOne-{{ $server->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample-{{ $server->id }}">
                                            <div class="accordion-body">
                                                <h5 class="text-center"><strong>INFORMACIÓN </strong></h5>
                                                <p class="card-text"><strong id="info1-{{ $server->id }}">Dirección Ip:
                                                        {{ $server->serverip }}</strong></p>
                                                <p class="card-text"><strong id="info2-{{ $server->id }}">Tiempo en
                                                        Estado:
                                                        {{ $server->statustime }}</strong></p>
                                                <p class="cart-text"><strong id="info3-{{ $server->id }}">Ultima
                                                        Revisión:
                                                        {{ $server->lastcheck }}</strong></p>
                                                <p class="card-text"><strong id="info4-{{ $server->id }}">Inicio de
                                                        Estado:
                                                        {{ $server->lastresponse }}</strong></p>
                                                <p class="card-text"><strong id="info5-{{ $server->id }}">Descripción:
                                                        {{ $server->description }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-lg btn-outline-primary btn-checkone"
                                    data-server-id="{{ $server->id }}">
                                    <i class="bi bi-arrow-repeat fa-10x button-icon" id="icon-check-one-{{ $server->id }}"></i>
                                    <span class="spinner-border spinner-border-sm button-loading"
                                        id="spn-check-one-{{ $server->id }}" aria-hidden="true" hidden="true"></span>
                                </button>

                                <button class="btn btn-lg btn-outline-info" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne-{{ $server->id }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne-{{ $server->id }}">
                                    <i class="bi bi-eye-slash"></i>
                                </button>

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
                <div class="col-md-4 mb-1">
                    <div class="card p-3">
                        <div class= "m-0 col alert alert-secondary" role="alert" style="text-align: center;">
                            <strong>NO HAY SERVIDORES QUE MOSTRAR</strong>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

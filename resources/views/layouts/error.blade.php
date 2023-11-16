@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">404</h1>
                <p class="fs-3"> <span class="text-danger">Opps!</span> Pagina no Encontrada.</p>
                <p class="lead">
                    La pagina a la que buscas acceder no existe.
                  </p>
                <a href="{{ route('inicio') }}" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
@endsection

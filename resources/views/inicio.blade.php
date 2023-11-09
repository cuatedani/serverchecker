@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem; box-shadow: 0 0 30px rgba(0, 0, 0, 0.7);">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://www.internetya.co/wp-content/uploads/2023/06/centro-datos-racks-servidores-sala-pasillo-render-3d-datos-digitales-tecnologia-nube-scaled.jpg"
                                    alt="Imagen Inicio" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem; overflow: width: 50%; height: 495px; hidden;" />

                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <div class="d-flex align-items-center mb-3 pb-1"> <svg style="color: #000000;"
                                            xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-house-fill me-3" viewBox="0 0 16 16">
                                            <path
                                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                            <path
                                                d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                                        </svg>
                                        <span class="h1 fw-bold mb-0">Bienvenido</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Ingresa con tu cuenta
                                    </h5>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-floating mb-4">
                                            <input id="email" type="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                placeholder="" name="email" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus />

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ 'Por favor ingresa un correo valido' }}</strong>
                                                </span>
                                            @enderror
                                            <label class="form-label" for="correo">Correo:</label>
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input type="password" id="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password" placeholder="" />

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>Por favor ingresa tu contraseña.</strong>
                                                </span>
                                            @enderror
                                            <label class="form-label" for="password">Contraseña:</label>
                                        </div>

                                        <div class="pt-1 mb-4 d-grid gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="remember">{{ __('Recuérdame') }}</label>
                                            </div>
                                            <button class="btn btn-dark btn-lg btn-block" type="submit"
                                                style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">Iniciar
                                                Sesión</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

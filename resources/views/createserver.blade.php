@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Añadir Servidor') }}
            </h2>

            <form method="POST" action="{{ route('server.create') }}" class="mt-4">
                @csrf

                <!-- Nombre del Servidor -->
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Nombre del Servidor:') }}</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campos de la IP -->
                <div class="form-group mt-4">
                    <label class="form-label">{{ __('IP del Servidor:') }}</label>
                    <div class="input-group">
                        <input class="form-control" type="number" name="ip_part1" value="{{ old('ip_part1') }}" min="1" max="255" required />
                        <span class="input-group-text">.</span>
                        <input class="form-control" type="number" name="ip_part2" value="{{ old('ip_part2') }}" min="0" max="255" required />
                        <span class="input-group-text">.</span>
                        <input class="form-control" type="number" name="ip_part3" value="{{ old('ip_part3') }}" min="0" max="255" required />
                        <span class="input-group-text">.</span>
                        <input class="form-control" type="number" name="ip_part4" value="{{ old('ip_part4') }}" min="0" max="255" required />
                    </div>
                    @error('ip_part1')
                        <div class="text-danger ml-2">{{ $message }}</div>
                    @enderror
                    @error('ip_part2')
                        <div class="text-danger ml-2">{{ $message }}</div>
                    @enderror
                    @error('ip_part3')
                        <div class="text-danger ml-2">{{ $message }}</div>
                    @enderror
                    @error('ip_part4')
                        <div class="text-danger ml-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="form-group mt-4">
                    <label for="description" class="form-label">{{ __('Descripción:') }}</label>
                    <textarea id="description" class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <button class="btn btn-primary">{{ __('Añadir') }}</button>
                    <a href="{{ route('servers.show') }}" class="btn btn-warning ml-2">{{ __('Cancelar') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection

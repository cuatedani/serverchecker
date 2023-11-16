@extends('layouts.app')

@section('content')
            <div class="container">
                <form id="add-server-form" method="POST" action="/server/add">

                    <!-- Nombre del Servidor -->
                    <div class="form-group">
                        <label class="form-label">Nombre del Servidor : </label>
                        <input id="name" class="form-control" type="text" name="name" required autofocus autocomplete="name"
                            minlength="4" maxlength="25" />
                        <div id="validationname" class="invalid-feedback">
                            Por favor ingresa un nombre de entre 4 y 25 caracteres.
                        </div>
                    </div>

                    <!-- Campos de la IP -->
                    <div class="form-group mt-4">
                        <label class="form-label">IP del Servidor : </label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="ip_part1" value=" 'ip_part1' " min="1"
                                max="255" required />
                            <div id="validationip_part1" class="invalid-feedback">
                                Por favor ingresa una direccion entre 1 y 255.
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                </svg>
                            </span>
                            <input class="form-control" type="number" name="ip_part2" value=" 'ip_part2' " min="0"
                                max="255" required />
                            <div id="validationip_part2" class="invalid-feedback">
                                Por favor ingresa una direccion entre 0 y 255.
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                </svg>
                            </span>
                            <input class="form-control" type="number" name="ip_part3" value=" 'ip_part3' " min="0"
                                max="255" required />
                            <div id="validationip_part3" class="invalid-feedback">
                                Por favor ingresa una direccion entre 0 y 255.
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-dot" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                </svg>
                            </span>
                            <input class="form-control" type="number" name="ip_part4" value=" 'ip_part4' " min="0"
                                max="255" required />
                            <div id="validationip_part4" class="invalid-feedback">
                                Por favor ingresa una direccion entre 0 y 255.
                            </div>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="form-group mt-4">
                        <label for="description" class="form-label"> Descripción : </label>
                        <textarea id="description" minlength="5" class="form-control" name="description" rows="3" required minlength="4"
                            maxlength="200"></textarea>
                        <div id="validationdescription" class="invalid-feedback">
                            Por favor ingresa una descripcion de entre 4 y 200 caracteres.
                        </div>
                    </div>
                    <div class="col-12 text-center mt-3" style="display: none;" id="submitButtonContainer">
                        <button class="btn btn-primary" type="submit" id="submitButton">Submit form</button>
                    </div>
                </form>
            </div>
@endsection

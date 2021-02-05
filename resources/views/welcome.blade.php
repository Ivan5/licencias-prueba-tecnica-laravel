<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link
            href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap"
            rel="stylesheet"
        />

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    </head>
    <body>
        <main>
            <section class="banner">
                <div class="container">
                    <h1>Licencias</h1>
                </div>
            </section>
            <section class="form">
                <h3>Crear licencia</h3>
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <div>
                        <input
                            type="text"
                            placeholder="Nombre"
                            name="name"
                            required
                            class="input-css"
                        />
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}}</div>
                        @enderror
                    </div>
                    <div>
                        <select name="vig" id="vig" class="select-css">
                            <option
                                value=""
                                selected
                                disabled
                                aria-required="true"
                            >
                                Vigencia
                            </option>
                            <option value="1">5 minutos</option>
                            <option value="2">10 minutos</option>
                            <option value="3">15 minutos</option>
                            <option value="4">20 minutos</option>
                        </select>
                        @error('vig')
                        <div class="alert alert-danger">{{ $message }}}</div>
                        @enderror
                    </div>
                    <div>
                        <select name="prod" id="prod" class="select-css">
                            <option
                                value=""
                                selected
                                disabled
                                aria-required="true"
                            >
                                Producto
                            </option>
                            <option value="1">5 equipos</option>
                            <option value="2">10 equipos</option>
                            <option value="3">15 equipos</option>
                            <option value="4">20 equipos</option>
                        </select>
                        @error('prod')
                        <div class="alert alert-danger">{{ $message }}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="button primary">Crear</button>
                </form>
            </section>
            <section class="lista">
                <div class="container">@yield('content')</div>
            </section>
        </main>
    </body>
</html>

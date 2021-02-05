@extends('welcome') @section('content')
<h2>Licencias Creadas</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Vigencia</th>
            <th>Producto</th>
            <th>Estatus</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($licencias as $licencia)
        <tr>
            <td>{{ $licencia["id"] }}</td>
            <td>{{ $licencia["name"] }}</td>
            <td>{{ $licencia["code"] }}</td>
            <td>
                @if ($licencia['vig'] == 1) 5 minutos @endif 
                @if ($licencia['vig'] == 2) 10 minutos @endif 
                @if ($licencia['vig'] == 3) 15 minutos @endif 
                @if ($licencia['vig'] == 4) 20 minutos @endif
            </td>
            <td>
                @if ($licencia['prod'] == 1) 5 equipos @endif 
                @if ($licencia['prod'] == 2) 10 equipos @endif 
                @if ($licencia['prod'] == 3) 15 equipos @endif 
                @if ($licencia['prod'] == 4) 20 equipos @endif
            </td>
            <td>
                @if ($licencia['status'] == 1) Inactiva @endif 
                @if ($licencia['status'] ===2) Activa @endif 
                @if ($licencia['status'] == 3) Desactivada @endif 
                @if ($licencia['status'] == 4) Expirada @endif
            </td>
            <td>
                @if ($licencia['status'] == 1)
                <form
                    action="{{ route('activar', [$licencia['id']]) }}"
                    method="POST"
                >
                    @csrf
                    <button type="submit" class="button activar">
                        Activar
                    </button>
                </form>
                @endif @if($licencia['status'] == 2)
                <form
                    action="{{ route('desactivar', [$licencia['id']]) }}"
                    method="POST"
                >
                    @csrf

                    <button type="submit" class="button desactivar">
                        Desactivar
                    </button>
                </form>
                @endif @if ($licencia['status'] == 3)
                <form
                    action="{{ route('activar', [$licencia['id']]) }}"
                    method="POST"
                >
                    @csrf

                    <button type="submit" class="button activar">
                        Activar
                    </button>
                </form>
                @endif @if ($licencia['status'] == 4)
                <form
                    action="{{ route('renovar', [$licencia['id']]) }}"
                    method="POST"
                >
                    @csrf

                    <button type="submit" class="button renovar">
                        Renovar
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@extends('welcome')
@section('content')
    <h1>Create</h1>
    <form action="{{route('store')}}" method="POST">
      @csrf
      <div>
        <input type="text" placeholder="Nombre" name="name" required>
        @error('name')
          <div class="alert alert-danger">{{$message}}}</div>
        @enderror
      </div>
      <div>
        <select name="vig" id="vig">
          <option value="" selected disabled aria-required="true">Vigencia</option>
          <option value="1">5 minutos</option>
          <option value="2">10 minutos</option>
          <option value="3">15 minutos</option>
          <option value="4">20 minutos</option>
        </select>
        @error('vig')
          <div class="alert alert-danger">{{$message}}}</div>
        @enderror
      </div>
      <div>
        <select name="prod" id="prod" >
          <option value="" selected disabled aria-required="true">Producto</option>
          <option value="1">5 equipos</option>
          <option value="2">10 equipos</option>
          <option value="3">15 equipos</option>
          <option value="4">20 equipos</option>
        </select>
        @error('prod')
          <div class="alert alert-danger">{{$message}}}</div>
        @enderror
      </div>
      
      <button type="submit">Crear</button>
    </form>
@endsection
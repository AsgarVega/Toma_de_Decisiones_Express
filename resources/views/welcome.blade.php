@extends('layouts.general'){{-- se llama a la plantilla en la carpera resources/views/... y por defecto lavavel presupone el .blade.php --}}

@section('titulo1', 'Seleccione las dimenciones de la tabla'){{-- forma compacta cuando solo quieres remplazar algo sencillo en la plantilla --}}

{{-- forma normal para contenido extenso --}}
@section('contenido')
<form action="/cuadricula" method="POST">
    @csrf {{-- Esto de aqui le da un id al formulario que hace no caduque, 
    ya que laravel por seguridad marca como caducados todos los formularios
    que no esten en la lista (evita inyecciones de codigo) --}}
    <div class="col-4 d-flex justify-content-center text-center">
        <label style="font-weight:bold" for="estados" class="col-sm-2 col-form-label">Estados</label>
        <div class="col-sm-10">
            <input name="e_size" type="number" class="form-control" id="estados" placeholder="2-5" min="2" max="5" required>
            <span class="validity"></span>
        </div>
    </div>
    <div class="col-4 d-flex justify-content-center text-center">
        <label style="font-weight:bold" for="desiciones" class="col-sm-2 col-form-label">Desiciones</label>
        <div class="col-sm-10">
            <input name="a_size" type="number" class="form-control" id="desiciones" placeholder="2-5" min="2" max="5" required>
            <span class="validity"></span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-3 d-flex justify-content-center text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>
@endsection


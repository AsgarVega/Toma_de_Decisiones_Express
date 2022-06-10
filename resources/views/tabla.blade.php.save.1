@extends('layouts.general'){{-- se llama a la plantilla en la carpera resources/views/... y por defecto lavavel presupone el .blade.php --}}

@section('titulo1', 'Rellenado De datos'){{-- forma compacta cuando solo quieres remplazar algo sencillo en la plantilla --}}

{{-- forma normal para contenido extenso --}}
@section('contenido')
<form method="POST" action="/calcular" class="text-center">
    @csrf {{-- Esto de aqui le da un id al formulario que hace no caduque, 
        ya que laravel por seguridad marca como caducados todos los formularios
        que no esten en la lista (evita inyecciones de codigo) --}}
        <font color="white">
    <div class="form-group row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Decision/Estado</th>
                    @for ($i = 1; $i < $estados+1; $i++)
                        <th scope="col"><?='e<sub>'.$i.'</sub>'?></th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i < $decisiones+1; $i++)
                <tr>
                    @for ($j = 0; $j < $estados+1; $j++)
                        @if ($j==0)
                            <th><?='a<sub>'.$i.'</sub>'?></th>
                        @else
                        <th>
                            <input name='x_{{$i.$j}}' type="number" required>
                        </th>
                        @endif
                    @endfor
                </tr>
                @endfor
                <tr>
                    <th>__</th>
                </tr>
                <tr>
                
                    <th bgcolor="Red">Probabilidad</th>
                   
                    @for ($i = 1; $i < $estados+1; $i++)
                        <th>
                            <input name='p{{$i}}' type="number" min="0" max="1" step="0.01" required>
                        </th>
                    @endfor
                </tr>
                <tr>
                    <th>__</th>
                </tr>
              </tbody>
        </table>
    </div>
    </font>
    <div class="form-group row">
        <select name="criterio" class="form-control">
            <option value="0">Seleccione un criterio</option>
            <option value="1">Valor esperado</option>
            <option value="2">minima varianza con media acotada</option>
            <option value="3">media con varianza acotada</option>
            <option value="4">dispersion</option>
            <option value="5">probabilidad maxima</option>
            <option value="6">verosimilitud</option>
            <option value="7">utilidad</option>
            <option value="8">Modelo de Amplitud para Riesgo e Incertidumbre (MARI)</option>
        </select>
    </div>
    <font color="white">
    <div class="form-group row ">
        <table class="table table-bordered mx-auto d-block">
            <thead>
                <tr>
                    <th scope="col">Variable</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">K</th>
                <td><input name='k' type="number" min="0" step="0.01" value="0" required></td>
                </tr>
                <tr>
                <th scope="row">β</th>
                <td><input name='b' type="number" min="0" step="0.01" value="0" required></td>
                </tr>
                <tr>
                <th scope="row">r</th>
                <td><input name='r' type="number" min="0" step="0.01" value="0" required></td>
                </tr>
            </tbody>
        </table>
    </font>
    </div>
    {{-- variables ocultas --}}
    <input type="hidden" 
        name="estados" 
        value="{{$estados}}">
    <input type="hidden" 
        name="decisiones" 
        value="{{$decisiones}}">
    {{-- Boton de submit --}}
    <div class="form-group row">
        <button type="submit" class="btn btn-primary">Calcular</button>
    </div>
    
</form>
@endsection


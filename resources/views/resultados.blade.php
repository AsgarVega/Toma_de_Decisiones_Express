@extends('layouts.general'){{-- se llama a la plantilla en la carpera resources/views/... y por defecto lavavel presupone el .blade.php --}}

@section('titulo1')
<?=$resultado?>
@endsection
{{-- forma normal para contenido extenso --}}
@section('contenido')
<table class="table">
    <thead>
      <tr>
          @foreach ($headers as $item)
              <th><?=$item?></th>
          @endforeach
      </tr>
    </thead>
    <tbody>
        @foreach ($datos as $rows)
        <tr>
            @foreach ($rows as $item)
                <th><?=$item?></th>
            @endforeach
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection
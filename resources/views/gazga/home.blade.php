@extends('layouts.general'){{-- se llama a la plantilla en la carpera resources/views/... y por defecto lavavel presupone el .blade.php --}}

@section('titulo1', 'TITULO'){{-- forma compacta cuando solo quieres remplazar algo sencillo en la plantilla --}}

{{-- forma normal para contenido extenso --}}
@section('contenido')

<h1>contenido</h1>
@endsection


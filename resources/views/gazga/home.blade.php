@extends('layouts.general'){{-- se llama a la plantilla en la carpera resources/views/... y por defecto lavavel presupone el .blade.php --}}

@section('titulo1', 'TITULO'){{-- forma compacta cuando solo quieres remplazar algo sencillo en la plantilla --}}

{{-- forma normal para contenido extenso --}}
@section('contenido')
<div style="background-color: gray">
    <canvas id="myChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = {
        datasets: [{
            label: 'Utilidad',
            data: [
                {x: -30,y: -.49},
                {x: -6,y: -.08},
                {x: 0,y: 0},
                {x: 10,y: .12},
                {x: 25,y: 0.28},
                {x: 50,y: .49},
                {x: 80,y: .66},
                {x: 100,y: 0.74}
            ],
            backgroundColor: 'rgb(255, 99, 132)'
        },{
            label: 'Referencia',
            data: [
                {x: -30,y: -.49},
                {x: 100,y: 0.74}
        ],
            backgroundColor: 'rgb(0, 0, 0)'
        }],
        };
  
    const config = {
    type: 'line',
        data: data,
        options: {
            scales: {
            x: {
                type: 'linear',
                position: 'bottom'
            }
            }
        }
        };
  </script>
  <script>
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  </script>
@endsection


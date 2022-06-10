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
@if ($print=='SI')
    <br>
    <div style="background-color: gray">
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            datasets: [{
                label: 'Utilidad',
                data: [
                    @for ($i = 0; $i < sizeof($x); $i++)
                        {x: {{ $x[$i] }},y: {{ $u[$i] }}},
                    @endfor
                ],
                backgroundColor: 'rgb(255, 99, 132)'
            },{
                label: 'Referencia',
                data: [
                    {x: {{ $x[0] }},y: {{ $u[0] }}},
                    {x: {{ $x[(sizeof($x)-1)] }},y: {{ $u[(sizeof($x)-1)] }}},
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
@endif
@endsection
<table>
    <thead>
    <tr>
        <th>Marca</th>
        <th>N° MAP</th>
        <th>Año MAP</th>
        <th>Diametro MAP (original)</th>
        <th>DIAMETRO MAP (instalado)</th>
        <th>Lectura MAP</th>
        <th>Sellado (SI o NO)</th>
        <th>N° Radio MAP</th>
    </tr>
    </thead>
    <tbody>
        @if ($medidores)
            @foreach ($medidores as $med)
                <tr>
                    <td>{{$med->abreviatura}}</td>
                    <td>{{$med->numero}}</td>
                    <td>{{$med->ano}}</td>
                    <td>{{$med->medidor_actual_diametro}}</td>
                    <td>{{$med->medidor_nuevo_diametro}}</td>
                    <td>0</td>
                    <td>SI</td>
                    <td>-</td>
                </tr>
            @endforeach
           @endif
    </tbody>
</table>
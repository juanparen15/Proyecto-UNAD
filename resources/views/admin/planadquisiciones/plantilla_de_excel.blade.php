<table>
    <thead>
        <tr>
            <th>NÚMERO DE ORDEN</th>
            <th>ENTIDAD PRODUCTORA</th>
            <th>UNIDAD ADMINISTRATIVA</th>
            <th>OFICINA PRODUCTORA</th>
            <th>OBJETO</th>
            <th>CODIGO</th>
            <th>NOMBRE DE LA SERIE</th>
            <th>NOMBRE DE LA SUBSERIE O ASUNTOS</th>
            <th>FECHA INICIAL</th>
            <th>FECHA FINAL</th>
            <th>CAJA</th>
            <th>CARPETA</th>
            <th>TOMO</th>
            <th>OPCION OTRO</th>
            <th>OTRO</th>
            <th>NÚMERO DE FOLIOS</th>
            <th>SOPORTE</th>
            <th>FRECUENCIA DE CONSULTA</th>
            <th>NOTAS</th>
            <th>USUARIO INSTITUCIONAL</th>
            <th>REGISTRO DE ENTRADA</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>{{ $plan->id }}</td>
            <td>ALCALDIA MUNICIPAL DE PUERTO BOYACA, BOYACA</td>
            <td>{{ $plan->area->dependencia->nomdependencia }}</td>
            <td>{{ $plan->area->nomarea }}</td>
            <td>{{ $plan->modalidad->detmodalidad }}</td>
            <td>{{ $plan->requiproyecto->detproyeto }}</td>
            <td>{{ $plan->segmento->detsegmento }}</td>
            <td>{{ $plan->familias->detfamilia }}</td>
            <td>{{ $plan->fechaInicial }}</td>
            <td>{{ $plan->fechaFinal }}</td>
            <td>{{ $plan->caja }}</td>
            <td>{{ $plan->carpeta }}</td>
            <td>{{ $plan->tomo }}</td>
            <td>{{ $plan->requipoais->detpoai }}</td>
            <td>{{ $plan->otro }}</td>
            <td>{{ $plan->folio }}</td>
            <td>{{ $plan->fuente->detfuente }}</td>
            <td>{{ $plan->tipoprioridade->detprioridad }}</td>
            <td>{{ $plan->nota }}</td>
            <td>{{ $plan->user->email }}</td>
            <td>{{ $plan->updated_at }}</td>
            <td>

                {{-- @foreach ($plan->productos as $producto)
                {{$producto->id}},
                @endforeach --}}

            </td>
        </tr>

    </tbody>
</table>

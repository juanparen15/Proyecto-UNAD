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
            <th>CORREO USUARIO INSTITUCIONAL</th>
            <th>USUARIO INSTITUCIONAL</th>
            <th>REGISTRO DE ENTRADA</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($planadquisiciones as $planadquisicion)
            <tr>
                <td>{{ $planadquisicion->id }}</td>
                <td>ALCALDIA MUNICIPAL DE PUERTO BOYACA, BOYACA</td>
                <td>{{ $planadquisicion->area->dependencia->nomdependencia }}</td>
                <td>{{ $planadquisicion->area->nomarea }}</td>
                <td>{{ $planadquisicion->modalidad->detmodalidad }}</td>
                <td>{{ $planadquisicion->requiproyecto->detproyeto }}</td>
                <td>{{ $planadquisicion->segmento->detsegmento }}</td>
                <td>{{ $planadquisicion->familias->detfamilia }}</td>
                <td>{{ $planadquisicion->fechaInicial }}</td>
                <td>{{ $planadquisicion->fechaFinal }}</td>
                <td>{{ $planadquisicion->caja }}</td>
                <td>{{ $planadquisicion->carpeta }}</td>
                <td>{{ $planadquisicion->tomo }}</td>
                <td>{{ $planadquisicion->requipoais->detpoai }}</td>
                <td>{{ $planadquisicion->otro }}</td>
                <td>{{ $planadquisicion->folio }}</td>
                <td>{{ $planadquisicion->fuente->detfuente }}</td>
                <td>{{ $planadquisicion->tipoprioridade->detprioridad }}</td>
                <td>{{ $planadquisicion->nota }}</td>
                <td>{{ $planadquisicion->user->email }}</td>
                <td>{{ $planadquisicion->user->name }}</td>
                <td>{{ $planadquisicion->updated_at }}</td>
                <td>

                    {{-- @foreach ($planadquisicion->productos as $item)
                {{$item->id}},
                @endforeach --}}

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<?php

namespace App\Imports;

use App\Potencia;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;


class PotenciaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            // Verifica si hay al menos un elemento en la fila
            if (!empty($row['potencia'])) {
                // Obtiene el valor para la columna 'potencia'
                $potenciaValue = $row['potencia'];

                // Crea un nuevo modelo Potencia con la propiedad 'potencia' y 'slug' asignadas
                $potenciaModel = new Potencia([
                    'potencia' => $potenciaValue,
                    'slug' => Str::slug($potenciaValue),
                ]);

                return $potenciaModel;
            }
        } catch (\Exception $e) {
            // Manejo de errores
            Log::error("Error en la importación de Potencia: " . $e->getMessage());

            // Retorna null para indicar que hubo un error
            return null;
        }
    }
}

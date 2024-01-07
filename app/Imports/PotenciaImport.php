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
            // Busca las columnas necesarias en el array $row
            $potenciaValue = $row['potencia'] ?? null;
            $segundaPotenciaValue = $row['segundaPotencia'] ?? null;
            $terceraPotenciaValue = $row['terceraPotencia'] ?? null;
            $cuartaPotenciaValue = $row['cuartaPotencia'] ?? null;

            // Verifica si al menos una de las columnas necesarias tiene valor
            if (!empty($potenciaValue) || !empty($segundaPotenciaValue) || !empty($terceraPotenciaValue) || !empty($cuartaPotenciaValue)) {
                // Crea un nuevo modelo Potencia con las propiedades asignadas
                $potenciaModel = new Potencia([
                    'potencia' => $potenciaValue,
                    'segundaPotencia' => $segundaPotenciaValue,
                    'terceraPotencia' => $terceraPotenciaValue,
                    'cuartaPotencia' => $cuartaPotenciaValue,
                    'slug' => Str::slug($potenciaValue ?? $segundaPotenciaValue ?? $terceraPotenciaValue ?? $cuartaPotenciaValue),
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

    /**
     * @return array
     */
    public function headingRow(): int
    {
        return 1;
    }
}

<?php

namespace App\Imports;

use App\Potencia;
use App\Encabezado;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class PotenciaImport implements ToModel, WithHeadingRow
{
    private $headerRow;
    private $headerRows = [];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // session()->forget('excel_header');

        try {
            // Si no se ha guardado el encabezado, guárdalo y retorna null
            if (!$this->headerRow) {
                $this->headerRow = $row;
                session(['excel_header' => $this->headerRow]);
                $this->saveHeaderRowToDatabase($row);

                return null;
            }

            // Crea un nuevo modelo Potencia con las propiedades asignadas dinámicamente
            $potenciaModel = new Potencia();

            // Asigna los valores al modelo según la posición de la columna
            $columnIndex = 0;
            foreach ($row as $value) {
                // Obtiene el nombre de la columna de la base de datos según la posición
                $dbColumnName = $this->getColumnNameByIndex($columnIndex);
                $potenciaModel->$dbColumnName = $value ?? null;

                $columnIndex++;
            }

            // Puedes ajustar el código para el campo slug según tus necesidades
            $potenciaModel->slug = Str::slug(implode('-', $row));

            return $potenciaModel;
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

    /**
     * Guarda la primera fila (encabezados) en la base de datos
     */
    private function saveHeaderRowToDatabase(array $headerRow)
    {
        $encabezado = new Encabezado();
        // Eliminar todos los encabezados existentes
        Encabezado::truncate();

        // Itera sobre cada elemento del nuevo encabezado y guárdalo en la base de datos
        foreach ($headerRow as $header) {
            Encabezado::create(['encabezado' => $header]);
        }

        $encabezado->slug = Str::slug(implode('-', $headerRow));

        return $encabezado;
    }

    /**
     * Obtiene el nombre de la columna de la base de datos según la posición
     */
    private function getColumnNameByIndex(int $index): string
    {
        // En este ejemplo, se está utilizando un array asociativo
        // donde las claves son las posiciones y los valores son los nombres de las columnas de la base de datos
        $columnNames = [
            0 => 'latitud',
            1 => 'longitud',
            2 => 'potencia',
            3 => 'segundaPotencia',
            4 => 'terceraPotencia',
            5 => 'cuartaPotencia',
            6 => 'quintaPotencia',
            7 => 'sextaPotencia',
            // Agrega más según sea necesario
        ];

        return $columnNames[$index] ?? 'columna_desconocida';
    }
}

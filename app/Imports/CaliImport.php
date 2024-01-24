<?php

namespace App\Imports;

use App\PotenciaCali;
use App\EncabezadoCali;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;


//CALI

class CaliImport implements ToModel, WithHeadingRow
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
            $potenciaModel = new PotenciaCali();

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
        $encabezado = new EncabezadoCali();
        // Eliminar todos los encabezados existentes
        EncabezadoCali::truncate();

        // Itera sobre cada elemento del nuevo encabezado y guárdalo en la base de datos
        foreach ($headerRow as $header) {
            EncabezadoCali::create(['encabezadoCali' => $header]);
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
            // 0 => 'id',
            0 => 'latitudAM',
            1 => 'longitudAM',
            2 => 'potenciaAM',
            3 => 'latitudFM',
            4 => 'longitudFM',
            5 => 'potenciaFM',
            6 => 'latitudDABHibrido',
            7 => 'longitudDABHibrido',
            8 => 'potenciaDABHibrido',
            9 => 'latitudAMHibrido',
            10 => 'longitudAMHibrido',
            11 => 'SNRAMHibrido',
            12 => 'latitudFMHibrido',
            13 => 'longitudFMHibrido',
            14 => 'SNRFMHibrido',
            15 => 'latitudDAB',
            16 => 'longitudDAB',
            17 => 'SNRDAB',
            // Agrega más según sea necesario
        ];

        return $columnNames[$index] ?? 'columna_desconocida';
    }
}

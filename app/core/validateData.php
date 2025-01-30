<?php
class ValidateData
{

    // Lista negra de palabras comunes en SQL Injection
    private $blacklist = [
        'SELECT',
        'INSERT',
        'UPDATE',
        'DELETE',
        'INTO',
        'DROP',
        'TRUNCATE',
        'ALTER',
        'CREATE',
        'UNION',
        'REPLACE',
        'EXEC',
        'CALL',
        'WHERE',
        ' OR ',
        'AND',
        'XOR',
        'SLEEP',
        'BENCHMARK',
        'WAITFOR',
        'WAITFOR DELAY',
        '/*',
        '*/',
        '--',
        '#',
        ';',
        'NULL',
        'FROM',
        ' * ',
        ' TO '
    ];

    // Función para sanitizar datos pasados por parametros en un array
    public function sanitizeData($dataArray)
    {

        $sanitizedArray = [];

        foreach ($dataArray as $key => $value) {
            // Verificar si el valor contiene palabras de la lista negra
            foreach ($this->blacklist as $blackListValue) {
                if (stripos($value, $blackListValue) !== false) {
                    $value = str_ireplace($blackListValue, '', $value);
                }
            }

            // Sanitizar el valor
            $value = trim($value);
            $value = str_replace(["'", '"'], "", $value);

            $sanitizedArray[$key] = $value;
        }

        return $sanitizedArray;
    }

}
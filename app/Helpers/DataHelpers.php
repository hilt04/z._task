<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class DataHelpers
{
    /**
     * Converte uma data do padrão ISO 8601 para o padrão brasileiro
     */
    static private function converteDeISO8601ParaBr(string $dataEntrada): string
    {
        return Carbon::make($dataEntrada)->format('d/m/Y');
    }

        /**
     * Converte uma data do padrão brasileiro para o padrão ISO 8601
     */
    static private function converteDeBrParaISO8601(string $dataEntrada): string
    {
        return Carbon::createFromFormat('d/m/Y', $dataEntrada)->format('Y-m-d');
    }

    /**
     * Faz o cast de data para entrada e saida entre padrão brasileiro e iso 8601
     */
    static public function converteData(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => DataHelpers::converteDeISO8601ParaBr($value),
            set: fn (string $value) => DataHelpers::converteDeBrParaISO8601($value)
        );
    }
}
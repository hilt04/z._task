<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep'];

    /**
     * Mapeia o relacionamento com funcionário
     * Um endereço pertence a um funcionário
     * 
     * @return BelongsTo 
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Retorna o endereço completo formatado
     */
    protected function enderecoCompleto(): Attribute
    {
        return Attribute::make(
            get: function(mixed $value, array $attributes) {
                return vsprintf(
                    '%s, %s - %s, %s - %s %s (%s)',
                    [
                        $attributes['logradouro'],
                        $attributes['numero'],
                        $attributes['bairro'],
                        $attributes['cidade'],
                        $attributes['estado'],
                        $attributes['cep'],
                        $attributes['complemento'],
                    ]
                );
            }
        );
    }
}

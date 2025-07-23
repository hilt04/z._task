<?php

namespace App\Models;

use App\Helpers\DataHelpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'orcamento', 'data_inicio', 'data_final', 'client_id'];

    /**
     * Formata a data de inicio do projeto
     */
    protected function dataInicio(): Attribute
    {
        return DataHelpers::converteData();
    }

    /**
     * Formata a data de inicio do projeto
     */
    protected function dataFinal(): Attribute
    {
        return DataHelpers::converteData();
    }

    /**
     * Define um accessor para o campo orçamento
     */
    public function orcamento(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => number_format($value, 2, ',', '.'),
        );
    }

    /**
     * Um projeto pertence a um cliente
     * 
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    /**
     * Um projeto pertence a muitos funcionários
     * 
     * @return BelongsToMany 
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_project', 'project_id', 'employee_id');
    }

    /**
     * Cria um novo projeto com os funcionários alocados
     */
    static public function criarComFuncionarios(array $projeto, array $funcionariosAlocados): bool
    {
        try {
            DB::beginTransaction();

            $projeto = self::create($projeto);

            $projeto->employees()->sync($funcionariosAlocados);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return false;
        }

        return true;
    }

    /**
     * Atualizado projeto com os funcionários alocados
     */
    public function atualizarComFuncionarios(array $projeto, array $funcionariosAlocados): bool
    {
        try {
            DB::beginTransaction();

            $this->update($projeto);

            $this->employees()->sync($funcionariosAlocados);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return false;
        }

        return true;
    }
}

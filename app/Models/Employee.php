<?php

namespace App\Models;

use Carbon\Carbon;
use App\Helpers\DataHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    //protected $fillable = ['nome', 'cpf', 'data_contratacao', 'data_demissao'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Formata a data de contratação para entrada e saída
     */
    protected function dataContratacao(): Attribute
    {
        return DataHelpers::converteData();
    }

    /**
     * Mapeia o relacionamento com o endereço
     * Um funcionário tem um endereço
     * 
     * @return HasOne 
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    /**
     * Um funcionário pertence a muitos projetos
     * 
     * @return BelongsToMany 
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project', 'employee_id', 'project_id');
    }

    /**
     * Adiciona um escopo para funcionários não demitidos
     */
    public function scopeAtivo(Builder $query): void
    {
        $query->whereNull('data_demissao');
    }

    /**
     * Cria um novo funcionário com endereço no banco
     */
    static public function criar(array $funcionario, array $endereco): bool
    {
        try {
            DB::beginTransaction();
            
            $funcionario = Employee::create($funcionario);
    
            $funcionario->address()->create($endereco);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return false;
        }

        return true;
    }

    /**
     * Atualiza os dados do funcionário e o endereço
     */
    public function atualizar(array $funcionario, array $endereco): bool
    {
        try {
            DB::beginTransaction();
            
            $this->update($funcionario);
    
            $this->address()->update($endereco);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return false;
        }

        return true;
    }

    /**
     * Apaga o funcionário e seu endereço do banco
     */
    public function apagar(): bool
    {
        try {
            DB::beginTransaction();

            $this->address()->delete();

            $this->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return false;
        }

        return true;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'endereco', 'descricao'];

    /**
     * Um cliente tem muitos projetos
     * 
     * @return HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }
}

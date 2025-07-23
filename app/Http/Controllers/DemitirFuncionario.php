<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;

class DemitirFuncionario extends Controller
{
    /**
     * Demite um funcionário por ID
     */
    public function __invoke(Employee $funcionario)
    {
        if ($funcionario->data_demissao !== NULL) {
            return redirect()
                ->back()
                ->withErrors('Esse funcionário já estava demitido');
        }

        $funcionario->update([
            'data_demissao' => Carbon::now()
        ]);

        return redirect()
                ->route('funcionarios.index')
                ->with('mensagem', 'Funcionário demitido com sucesso!');
    }
}

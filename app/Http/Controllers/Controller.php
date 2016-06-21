<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    /**
     * Checa se o usuário atual não está autenticado, e já exibe mensagem de aviso
     *
     * @return boolean
     */
    public function isNaoAutenticado()
    {
        if (Auth::guest()) {
            Session::flash('flash_info', 'É necessário estar autenticado para realizar esta ação');
            return true;
        }
        return false;
    }

    /**
     * Checa se o usuário, que deve já estar autenticado, tem não permissão de edição
     *
     * @param  User|Solicitacao  $entity
     * @return boolean
     */
    public function cannotEdit($entity)
    {
        if (!$entity || !$entity->can_edit()) {
            Session::flash('flash_danger', 'Você não está autorizado a editar esta entidade');
            return true;
        }
        return false;
    }

    /**
     * Checa se o usuário, que deve já estar autenticado, tem não permissão de visualização
     *
     * @param  User|Solicitação $entity
     * @return boolean
     */
    public function cannotSee($entity)
    {
        if (!$entity || !$entity->can_see()) {
            Session::flash('flash_danger', 'Você não está autorizado a visualizar este paciente');
            return true;
        }
        return false;
    }
}

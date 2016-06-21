<?php

/**
 * @package    EcoService.EcoServiceWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

namespace App\Http\Middleware;

use Auth;
use Session;
use App\User;

/**
 * @todo mover este trait para o controller base App\Http\Controllers\Controller.
 *       nao e necessario trait para algo que herança tipica e o suficiente
 */
trait ComumControllers
{

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

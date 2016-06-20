<?php

/**
 * @package    EcoService.EcoServiceWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Solicitacao extends Model
{
    public function userEntidade()
    {
        return $this->hasOne('App\User', 'usuario_id');
    }
}

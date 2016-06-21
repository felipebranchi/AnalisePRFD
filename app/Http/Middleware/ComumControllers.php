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
    // @deprecated movido para Controller base
}

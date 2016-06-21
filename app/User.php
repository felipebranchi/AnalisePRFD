<?php
/**
 * @package    EcoService.EcoServiceWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Hash;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Quem pode editar esse usuário.
     *
     * @var array
     */
    public function can_edit()
    {
        if (Auth::guest()) {
            return false;
        }
        if ($this->id === Auth::user()->id || Auth::user()->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Quem pode ver esse usuário.
     *
     * @var array
     */
    public function can_see()
    {
        return $this->can_edit();
    }

    /**
     * Retorna se o usuário atual é um administrador
     *
     * @return bool
     */
    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function solicitacao()
    {
        $results = $this->hasMany('App\Solicitacao', 'id', 'user_id')->getResults();
        return !empty($results) ? $results : null;
    }
}

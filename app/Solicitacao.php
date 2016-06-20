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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cep',
        'uf',
        'cidade', 
        'bairro', 
        'endereco', 
        'endereco_complemento', 
        'observacao', 
        'tipo'
    ];
    
    /**
     * Tabela associada a user.
     *
     * @var string
     */
    protected $table = 'solicitacao';
    
    /**
     * Relacionamento entre entidades.
     *
     * @var array
     */
    public function userEntidade()
    {
        return $this->hasOne('App\User', 'usuario_id');
    }
    
    /**
     * Retorna anexo, caso exista
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\User')->getResults();
    }
    
    /**
     * Retorna se um dado ID de usuário pode editar esta entidade
     *
     * @return Array
     */
    public function can_edit()
    {
        return true;
    }
    
    /**
     * Quem pode ver esse usuário.
     *
     * @var array
     */
    public function can_see()
    {
        return true;
    }
    
}
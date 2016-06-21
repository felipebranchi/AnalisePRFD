<?php
/**
 * @package    IdentRad.IdentRadWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

namespace App\Http\Middleware;

trait Lista
{

    /**
     * Lista com estados da Federação
     */
    public static $SOLICITACAO = [
        '0' => 'Poda de árvore',
        '1' => 'Remoção de árvore',
        '2' => 'Remoção de lixo doméstico',
        '3' => 'Remoção de lixo hospitalar',
        '4' => 'Remoção de entulho'
    ];

    /**
     * Lista com estados da Federação
     */
    public static $UF = [
        '' => '- Selecione uma UF -',
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins'
    ];

}

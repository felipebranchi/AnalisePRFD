<?php

/**
 * @package    EcoService.EcoServiceWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Solicitacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->string('cep', 10)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('endereco', 60)->nullable();
            $table->string('endereco_complemento', 10)->nullable();
            $table->string('observacao', 255)->nullable();
            $table->tinyInteger('tipo')->default(0)->comment('0: poda de arvore; 1: remoçao de arvore; 2: remoçao de lixo domestico; 3: remoçao de lixo hospitalar; 4: remoçao de entulho');
            $table->timestamps();
            
            $table->foreign('usuario_id')->references('id')->on('user')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('solicitacao');
    }
}

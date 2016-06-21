<?php

/**
 * @package    EcoService.EcoServiceWeb
 *
 * @author     Renata Givisiez <rcgivisiez@gmail.com>
 * @copyright  Copyright (C) 2016 Renata Givisiez. All rights reserved.
 * @license    The MIT License (MIT)
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Middleware\ComumControllers;
use Redirect;
use Auth;
use Session;
use Storage;
use App\Solicitacao;
use App\User;

class SolicitacaoController extends Controller
{
    
    use ComumControllers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitacoes = Solicitacao::where(function($query) {
            //$query->where('user_id', '=', Auth::user()->id);
        })->paginate(20);

        return view('solicitacao.index')->withSolicitacoes($solicitacoes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (ComumControllers::isNaoAutenticado()) {
            Session::flash('flash_info', 'É necessário estar logado para criar nova solicitação');
            return redirect(route('home'));
        }
        
        return view('solicitacao.create')->withUser($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'usuario_id' => 'required',
            'data' => 'required',
            'descricao' => 'required'
        ]);

        // Valida se usuario logado pode mesmo criar algo relacionado a paciente_id
        $paciente_id = $request->input('paciente_id');
        $paciente = null;
        if ($paciente_id) {
            $paciente = Paciente::findOrFail($paciente_id);
            //dd($paciente);
            if (!$paciente || !$paciente->can_edit()) {
                Session::flash('flash_info', 'Você não tem autorização para fazer isso');
                return redirect(route('home'));
            }
        } else {
            Session::flash('flash_info', 'É necessário escolher um paciente para criar novo procedimento');
            return redirect(route('home'));
        }

        // @todo checar se este usuario REALMENTE pode salvar dentista_id.        

        $input = $request->all();

        //$input = $this->limpezaGenerica($input);

        $procedimento = Procedimento::create($input);

        // Checa permissões se o usuário pode editar; Superadministrador pode
        // passar por cima das permissoes
        if (!$procedimento->can_edit()) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('procedimento.index'));
        }

        Session::flash('flash_info', 'Procedimento adicionada');

        return Redirect::action('ProcedimentoController@edit', array($procedimento->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $procedimento = Procedimento::findOrFail($id);
        return view('procedimento.show')->withProcedimento($procedimento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procedimento = Procedimento::findOrFail($id);

        // Checa permissões se o usuário pode editar; Superadministrador pode
        // passar por cima das permissoes
        if (!$procedimento->can_edit()) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('procedimento.index'));
        }

        return view('procedimento.edit')->withProcedimento($procedimento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // @todo garantir que o usuario autenticado REALMENTE possa atualizar este paciente_id
        //       atualmente ele poderia atualizar como se fosse outro paciente
        // @todo checar se este usuario REALMENTE pode salvar dentista_id.   

        $procedimento = Procedimento::findOrFail($id);

        // Checa permissões se o usuário pode editar; Superadministrador pode
        // passar por cima das permissoes
        if (!$procedimento->can_edit()) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('procedimento.index'));
        }

        $this->validate($request, [
            'paciente_id' => 'required',
            'data' => 'required',
            'descricao' => 'required'
        ]);

        $input = $request->all();

        $procedimento->fill($input)->save();

        Session::flash('flash_info', 'Procedimento atualizado com sucesso!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $procedimento = Procedimento::findOrFail($id);

        // Checa permissões se o usuário pode editar; Superadministrador pode
        // passar por cima das permissoes
        if (!$procedimento->can_edit()) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('procedimento.index'));
        }

        $procedimento->delete();

        Session::flash('flash_info', 'Procedimento removido com sucesso!');

        return redirect()->route('procedimento.index');
    }
}

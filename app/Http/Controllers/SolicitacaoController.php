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
use App\Http\Middleware\Lista;
use Redirect;
use Auth;
use Session;
use Storage;
use App\Solicitacao;
use App\User;

class SolicitacaoController extends Controller
{

    use ComumControllers,
        Lista;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::guest()) {
            Session::flash('flash_info', 'Para ver suas solicitações, é necessário ter um cadastro e estar autenticado.<br> Não tem uma conta ainda? <a href="' . url('/register') . '">Cadastre-se no site clicando aqui! </a>');
            //$this->middleware('auth');
            return redirect('/login');
        }

        //$isAdmin = Auth::user()->isAdmin();
        $user = Auth::user();

        $solicitacoes = Solicitacao::where(function($query) use ($user) {
                //$query->where('user_id', '=', Auth::user()->id);
                if (!$user->isAdmin()) {
                    $query->where('user_id', '=', $user->id);
                }
            })->paginate(20);

        return view('solicitacao.index')->withSolicitacoes($solicitacoes)
                ->with('listasolicitacao', self::$SOLICITACAO)
                ->with('listauf', self::$UF);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guest()) {
            Session::flash('flash_info', 'É necessário estar logado para criar nova solicitação');
            return redirect(route('home'));
        }

        $user = Auth::user();

        return view('solicitacao.create')->withUser($user)
                ->with('listasolicitacao', self::$SOLICITACAO)
                ->with('listauf', self::$UF);
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
            'tipo' => 'required',
            'uf' => 'required',
            'cidade' => 'required',
            'endereco' => 'required'
        ]);

        $input = $request->all();

        //$input['user_id'] = Auth::user()->id;

        $solicitacao = Solicitacao::create($input);

        // Checa permissões se o usuário pode editar; Superadministrador pode
        // passar por cima das permissoes
        if (!$solicitacao->can_edit()) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('solicitacao.index'));
        }

        Session::flash('flash_info', 'Solicitacao adicionada');

        return Redirect::action('SolicitacaoController@show', array($solicitacao->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitacao = Solicitacao::findOrFail($id);
        return view('solicitacao.show')->withSolicitacao($solicitacao)
                ->with('listasolicitacao', self::$SOLICITACAO)
                ->with('listauf', self::$UF);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitacao = Solicitacao::findOrFail($id);

        // Checa permissões se o usuário pode editar; Superadministrador pode
        // passar por cima das permissoes
        if (!$solicitacao->can_edit()) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('solicitacao.index'));
        }

        return view('solicitacao.edit')->withSolicitacao($solicitacao)
                ->with('listasolicitacao', self::$SOLICITACAO)
                ->with('listauf', self::$UF);
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
        $solicitacao = Solicitacao::findOrFail($id);

        // Checa permissões se o usuário pode editar; Superadministrador pode
        // passar por cima das permissoes
        if (!$solicitacao->can_edit()) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('solicitacao.index'));
        }

        $this->validate($request, [
            'tipo' => 'required',
            'uf' => 'required',
            'cidade' => 'required',
            'endereco' => 'required'
        ]);

        $input = $request->all();

        $solicitacao->fill($input)->save();

        Session::flash('flash_info', 'Solicitação atualizado com sucesso!');

        return redirect(route('solicitacao.show', $solicitacao->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitacao = Solicitacao::findOrFail($id);

        // Checa permissões se o usuário pode editar; Superadministrador pode
        // passar por cima das permissoes
        if (!$solicitacao->can_edit()) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('solicitacao.index'));
        }

        $solicitacao->delete();

        Session::flash('flash_info', 'Solicitacao removido com sucesso!');

        return redirect()->route('solicitacao.index');
    }
}

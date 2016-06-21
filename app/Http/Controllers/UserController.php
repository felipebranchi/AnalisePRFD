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
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Middleware\ComumControllers;
use App\User;
use Auth;
use Hash;
use Session;
use Redirect;

class UserController extends Controller
{
    
    use ResetsPasswords,
        ComumControllers;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if ($this->isNaoAutenticado()) {
            return redirect()->guest('login');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Redirect::action('PaginaController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'nome' => 'required',
        ]);

        $input = $request->all();

        $user = User::create($input);

        if (!$user->can_edit(Auth::user()->id)) {
                Session::flash('flash_info', 'Você não tem autorização para fazer isso');
                return redirect(route('user.index'));
        }

        Session::flash('flash_info', 'Usuário adicionado');

        return Redirect::action('UserController@edit', array($user->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (!$user->can_edit(Auth::user()->id)) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('user.index'));
        }

        return view('user.edit')->withUser($user);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redefinirsenha()
    {

        $user = Auth::user();

        return view('user.changepassword')->withUser($user);
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
        $user = User::findOrFail($id);

        
        if (!$user->can_edit(Auth::user()->id)) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('user.index'));
        }

        $input = $request->all();

        $user->fill($input)->save();

        Session::flash('flash_info', 'Usuário atualizado com sucesso!');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepassword(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $hashedPassword = $user->password;

        if (!empty($input['password'])) {
            if ($input['password'] !== $input['password_confirm']) {
                Session::flash('flash_danger', 'Senhas inseridas não são iguais');
            } else {
                $this->resetPassword($user, $input['password']);
                Session::flash('flash_info', 'Senha atualizada');
            }
        }

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
        $user = User::findOrFail($id);

        if (!$user->can_edit(Auth::user()->id)) {
            Session::flash('flash_info', 'Você não tem autorização para fazer isso');
            return redirect(route('user.index'));
        }

        $user->delete();

        Session::flash('flash_info', 'Usuário removido com sucesso!');

        return redirect()->route('user.index');
    }
}
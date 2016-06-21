@extends('layouts.app', [
'title' => "User " . $user->nome,
'description' => "User " . $user->nome,
])
@section('content')
<div id="conteudo" class="container">
  <article itemscope itemtype="http://schema.org/Person">
    <h1 itemprop="name">
      {{ $user->nome }}
      @if (Auth::check() && $user->can_edit())
      <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary idr-cta-edit">Editar usuário</a>
      @endif
    </h1>
    <div class="row">
      <div class="col-md-6">
        <dl>
          <dt>Email</dt>
          <dd>{{ $user->email }}</dd>
          <dt>Nome</dt>
          <dd>{{ $user->name }}</dd>
        </dl> 
      </div>
  </article>
</div>
@stop

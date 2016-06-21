@extends('layouts.app', [
'title' => "User " . $user->name,
'description' => "User " . $user->name,
])

@section('content')
<div id="conteudo" class="container">
  <article itemscope itemtype="http://schema.org/Person">
    <h1 itemprop="name">
      {{ $user->name }}
    </h1>
    {!! Form::model($user, [
    'method' => 'PATCH',
    'route' => ['user.update', $user->id],
    'id' => 'form-user'
    ]) !!}

    <div class="form-group required">
      {!! Form::label('email', 'email:', ['class' => 'control-label']) !!}
      {!! Form::text('email', $user->email, ['class' => 'form-control', "required" => "required"]) !!}
    </div>
    <div class="form-group required">
      {!! Form::label('name', 'Nome:', ['class' => 'control-label']) !!}
      {!! Form::text('name', $user->name, ['class' => 'form-control', "required" => "required"]) !!}
    </div>

    <div class="row">
      <div class="col-xs-6">
        {!! Form::submit('Atualizar usuário', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
      </div>
      <div class="col-xs-6" style="text-align: right">
        {!! Form::open([
        'method' => 'DELETE',
        'route' => ['user.destroy', $user->id],
        'class' => 'idr-form-delete'
        ]) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </article>
</div>
@stop

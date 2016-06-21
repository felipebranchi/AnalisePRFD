@extends('layouts.app', [
'title' => "User " . $user->name,
'description' => "User " . $user->name,
])

@section('content')

<div id="conteudo" class="container">
  <article itemscope itemtype="http://schema.org/Person">
    <h1 itemprop="name">
      Alterar senha de {{ $user->name }}
    </h1>
    {!! Form::model($user, [
    'method' => 'PATCH',
    'route' => ['redefinir-senha-update', $user->id],
    'id' => 'form-user'
    ]) !!}

    <div class="form-group required">
      {!! Form::label('password', 'Senha antiga:', ['class' => 'control-label', "required" => "required"]) !!}
      {!! Form::password('old_password', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group required">
      {!! Form::label('password', 'Nova Senha:', ['class' => 'control-label']) !!}
      {!! Form::password('password', ['id'=> 'password', 'class' => 'form-control', "required" => "required"]) !!}
    </div>

    <div class="form-group required">
      {!! Form::label('password_confirm', 'Reconfirmar nova senha:', ['class' => 'control-label']) !!}
      {!! Form::password('password_confirm', ['class' => 'form-control', 'oninput' => 'check(this)', "required" => "required"]) !!}
    </div>
    <script>
        function check(input) {
          if (input.value !== document.getElementById('password').value) {
            input.setCustomValidity('Senhas não são iguais. Tente novamente.');
          } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
          }
        }
    </script>

    <div class="row">
      <div class="col-xs-6">
        {!! Form::submit('Atualizar senha', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </article>
</div>
@stop

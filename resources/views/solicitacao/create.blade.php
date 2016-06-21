@extends('layouts.app', [
'title' => "Nova Solicitação",
'description' => "Nova Solicitação ",
])
@section('content')
<article id="conteudo" class="container">
  @include('partials.form-alerts')

  <h1 itemprop="name">
    Nova Solicitação por {{ $user->name }}
  </h1>
  {!! Form::open([
  'route' => 'solicitacao.store',
  'id' => 'form-solicitacao',
  'files'=> true
  ]) !!}

  <div class="form-group required">
    {!! Form::label('tipo', 'Tipo de solicitação:', ['class' => 'control-label']) !!}
    {!! Form::select('tipo', $listasolicitacao, null, ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group required">
    {!! Form::label('uf', 'UF:', ['class' => 'control-label']) !!}
    {!! Form::select('uf', $listauf, "PR", ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group required">
    {!! Form::label('cidade', 'Cidade:', ['class' => 'control-label']) !!}
    {!! Form::text('cidade', "Curitiba", ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group">
    {!! Form::label('bairro', 'Bairro:', ['class' => 'control-label']) !!}
    {!! Form::text('bairro', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group required">
    {!! Form::label('endereco', 'Endereco:', ['class' => 'control-label']) !!}
    {!! Form::text('endereco', null, ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group">
    {!! Form::label('endereco_complemento', 'Número:', ['class' => 'control-label']) !!}
    {!! Form::text('endereco_complemento', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('cep', 'CEP:', ['class' => 'control-label']) !!}
    {!! Form::text('cep', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('observacao', 'Comentários adicionais:', ['class' => 'control-label']) !!}
    {!! Form::textarea('observacao', null, ['class' => 'form-control', 'rows' => 10]) !!}
  </div>

  {!! Form::submit('Criar', ['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
</article>

@stop

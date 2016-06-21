@extends('layouts.app', [
'title' => "Solicitação" . $solicitacao->id,
'description' => "Solicitação " . $solicitacao->id,
])
@section('content')
<article id="conteudo" class="container">
  @include('partials.form-alerts')

  <h1 itemprop="name">
    Solicitação {{ $solicitacao->id }}
  </h1>
  {!! Form::model($solicitacao, [
  'method' => 'PATCH',
  'route' => ['solicitacao.update', $solicitacao->id],
  'id' => 'form-solicitacao'
  ]) !!}

  <div class="form-group required">
    {!! Form::label('tipo', 'Tipo de solicitação:', ['class' => 'control-label']) !!}
    {!! Form::select('tipo', $listasolicitacao, $solicitacao->tipo, ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group required">
    {!! Form::label('uf', 'UF:', ['class' => 'control-label']) !!}
    {!! Form::select('uf', $listauf, $solicitacao->uf, ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group required">
    {!! Form::label('cidade', 'Cidade:', ['class' => 'control-label']) !!}
    {!! Form::text('cidade', $solicitacao->cidade, ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group">
    {!! Form::label('bairro', 'Bairro:', ['class' => 'control-label']) !!}
    {!! Form::text('bairro', $solicitacao->bairro, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group required">
    {!! Form::label('endereco', 'Endereco:', ['class' => 'control-label']) !!}
    {!! Form::text('endereco', $solicitacao->endereco, ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group">
    {!! Form::label('endereco_complemento', 'Número:', ['class' => 'control-label']) !!}
    {!! Form::text('endereco_complemento', $solicitacao->endereco_complemento, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('cep', 'CEP:', ['class' => 'control-label']) !!}
    {!! Form::text('cep', $solicitacao->cep, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('observacao', 'Comentários adicionais:', ['class' => 'control-label']) !!}
    {!! Form::textarea('observacao', $solicitacao->observacao, ['class' => 'form-control', 'rows' => 10]) !!}
  </div>

  <div class="row">
    <div class="col-xs-6">
      {!! Form::submit('Atualizar anexo', ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
    </div>
    <div class="col-xs-6" style="text-align: right">
      {!! Form::open([
      'method' => 'DELETE',
      'route' => ['solicitacao.destroy', $solicitacao->id],
      'class' => 'idr-form-delete'
      ]) !!}
      {!! Form::submit('Apagar esta solicitação?', ['class' => 'btn btn-danger es-form-delete']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</article>

@stop

@extends('layouts.app', [
'title' => "Solicitação" . $solicitacao->id,
'description' => "Solicitação " . $solicitacao->id,
])
@section('content')
<article id="conteudo" class="container">
  <h1 itemprop="name">
    Solicitação {{ $solicitacao->id }}
  </h1>
  {!! Form::model($solicitacao, [
  'method' => 'PATCH',
  'route' => ['solicitacao.update', $solicitacao->id],
  'id' => 'form-solicitacao'
  ]) !!}

  <div class="form-group required">
    {!! Form::label('data', 'Data da anexo:', ['class' => 'control-label']) !!}
    {!! Form::select('tipo', $listasolicitacao, $solicitacao->tipo, ['class' => 'form-control', "required" => "required"]) !!}
  </div>
  <div class="form-group required">
    {!! Form::label('observacao', 'Descrição:', ['class' => 'control-label']) !!}
    {!! Form::textarea('observacao', $solicitacao->observacao, ['class' => 'form-control', "required" => "required", 'rows' => 3]) !!}
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
      {!! Form::submit('Apagar esta solicitação?', ['class' => 'btn btn-danger idr-form-delete']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</article>

@stop

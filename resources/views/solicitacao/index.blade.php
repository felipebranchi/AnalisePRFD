@extends('layouts.app', [
'title' => "Solicitações",
'description' => "Listagem de todas as solicitações",
])
@section('content')

<section id="conteudo">
  <div class="row">
    <div class="col-md-12 pleme-grid-inner">
      <h1><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Lista de Solicitações
      </h1>

      @include('partials.solicitacoes')
      <div class="text-center">{!! $solicitacoes->render() !!}</div>
    </div>
  </div>
</section>
@stop

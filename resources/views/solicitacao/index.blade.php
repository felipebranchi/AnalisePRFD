@extends('layouts.app', [
'title' => "Solicitações",
'description' => "Listagem de todas as solicitações",
])
@section('content')

<section id="conteudo" class="container">
  <div class="row">
    <div class="col-md-12">
      <h1><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Lista de Solicitações

        <a href="{{ route('solicitacao.create') }}" class="btn btn-success idr-cta-edit">Criar nova solicitação</a>
      </h1>

      @include('partials.solicitacoes')
      <div class="text-center">{!! $solicitacoes->render() !!}</div>
    </div>
  </div>
</section>
@stop

@extends('layouts.app', [
'title' => "Solicitação" . $solicitacao->id,
'description' => "Solicitação " . $solicitacao->id,
])
@section('content')
<div id="conteudo" class="container">
  @include('partials.solicitacao')
</div>

@stop

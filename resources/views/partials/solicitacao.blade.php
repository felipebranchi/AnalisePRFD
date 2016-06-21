
<article>
  <h3><a href="{{ route('solicitacao.show', [$solicitacao->id]) }}">Solcititação #{{ $solicitacao->id }}</a>

    @if (Auth::check() && $solicitacao->can_edit())
    <a href="{{ route('solicitacao.edit', $solicitacao->id) }}" class="btn btn-primary idr-cta-edit">Editar</a>
    @endif


  </h3>
  <p>{{ $solicitacao->user_id }}
  <p>{{ $solicitacao->cep }}
  <p>{{ $solicitacao->uf }}
  <p>{{ $solicitacao->cidade }}
  <p>{{ $solicitacao->bairro }}
  <p>{{ $solicitacao->endereco }}
  <p>{{ $solicitacao->endereco_complemento }}
  <p>{{ $solicitacao->observacao }}
  <p>{{ $solicitacao->tipo }}
</article>

<article>
  <h3><a href="{{ route('solicitacao.show', [$solicitacao->id]) }}">
      @if (isset($listasolicitacao[(int) $solicitacao->tipo]))
      {{ $listasolicitacao[$solicitacao->tipo] }} #{{ $solicitacao->id }} 
      @else
      Solicitação #{{ $solicitacao->id }} 
      @endif

      @if ($solicitacao->user()->name)
      por {{ $solicitacao->user()->name }}
      @endif
    </a>

    @if (Auth::check() && $solicitacao->can_edit())
    <a href="{{ route('solicitacao.edit', $solicitacao->id) }}" class="btn btn-primary idr-cta-edit">Editar</a>
    @endif
  </h3>
  <div class="row">
    <div class="col-md-4">
      <dl>
        @if ($solicitacao->user())
        <dt>Solicitante</dt>
        <dd>{{ $solicitacao->user()->name }}<dd>
          @endif
        <dt>Tipo</dt>
        <dd>
          @if (isset($listasolicitacao[(int) $solicitacao->tipo]))
          {{ $listasolicitacao[$solicitacao->tipo] }}
          @else
          Não definida
          @endif
        <dd>
        <dt>UF</dt>
        <dd>{{ isset($listauf[$solicitacao->uf]) ? $listauf[$solicitacao->uf] : $solicitacao->uf }}<dd>
        <dt>Cidade</dt>
        <dd>{{ $solicitacao->cidade }}</dd>
        <dt>Bairro</dt>
        <dd>{{ $solicitacao->bairro ? $solicitacao->bairro : "Não informado" }}</dd>
        <dt>Endereço completo</dt>
        <dd>{{ $solicitacao->endereco . ' ' . $solicitacao->endereco_complemento }}</dd>
      </dl>
    </div>
    <div class="col-md-8">
      <dl>
        <dt>Comentários extras</dt>
        <dd>{{ $solicitacao->observacao ? $solicitacao->observacao : "Sem observações"}}</dd>
      </dl>
    </div>
  </div>
</article>
@extends('layout')

@section('cabecalho')
    @auth
        Bem vindo {{Auth::user()->name }}
    @endauth

    @guest()
        Bem vindo Visitante!
    @endguest

@endsection

@section('conteudo')
    @if(!empty($mensagem))
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endif

    @auth
        <a href="{{route('form_add_serie')}}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Série</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($series as $serie)
            <tr>

                <td>
                    <div class="row">
                        <div id="nome-serie-{{ $serie->id }}" class="float-left">{{ $serie->nome }}</div>

                        <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                            <input type="text" class="form-control" value="{{ $serie->nome }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                                    Feito
                                </button>
                                @csrf
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="/series/remover/{{$serie->id}}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir a série {{addslashes($serie->nome)}}?')">
                        @csrf
                        @method('delete')

                        <a href="/series/{{$serie->id}}/temporadas" class="btn btn-info btn-sm">Ver</a>

                        @auth
                            <div class="btn btn-primary btn-sm" onclick="toggleInput({{$serie->id}})">Editar</div>
                            <button class="btn btn-danger btn-sm">Deletar</button>
                        @endauth
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function toggleInput(serieId) {
            const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
            const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;
            } else {
                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;
            }
        }

        function editarSerie(serieId) {
            let formData = new FormData();
            const nome = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('nome', nome);
            formData.append('_token', token);

            // enviar para uma rota

            const url = `/series/${serieId}/editaNome`;

            // Faz uma requisição
            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = nome;
            });
        }
    </script>
@endsection()

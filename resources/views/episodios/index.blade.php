@extends('layout')

@section('cabecalho')
    {{$serie->nome}}
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<a href="{{route('listar_series')}}" class="btn btn-primary mb-2">Listar séries</a>

<form action="/series/temporadas/{{$serie->id}}/{{$temporadaId}}/episodios/assistir" method="POST">
    @csrf
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Episodios</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($episodios as $episodio)
            <tr>
                <td>
                    <a href="#">Episódio {{$episodio->numero}}</a>
                </td>
                <td>
                    <div class="form-group form-check">
                        <input type="checkbox" name="episodios[]" value="{{$episodio->id}}" {{ $episodio->assistido ? 'checked' : '' }}>
                        <label for="episodios">Assistido</label>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @auth
        <button class="btn btn-primary mb-2">Salvar</button>
    @endauth
</form>
@endsection

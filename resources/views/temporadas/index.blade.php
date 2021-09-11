@extends('layout')

@section('cabecalho')
    {{$serie->nome}}
@endsection

@section('conteudo')

<a href="{{route('listar_series')}}" class="btn btn-primary mb-2">Listar séries</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Temporadas</th>
            <th>Episódios</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($temporadas as $temporada)
        <tr>
            <td>
                <a href="/series/temporadas/{{$serie->id}}/{{$temporada->id}}/episodios">Temporada {{ $temporada->numero }}</a>
            </td>
            <td>
                <span class="badge badge-secondary" style="background: gray;">
                    {{$temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count() }}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

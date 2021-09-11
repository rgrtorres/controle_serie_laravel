@extends('layout')

@section('cabecalho')
    Adicionar Série
@endsection

@section('conteudo')
    @include('erros', ['errors' => $errors])

    <form action="" method="POST">
        @csrf

        <div class="row">
            <div class="col col-8">
                <label for="name">Nome:</label>
                <input type="text" class="form-control mb-2" name="nome" id="nome">
            </div>

            <div class="col col-2">
                <label for="name">Temporadas:</label>
                <input type="number" class="form-control mb-2" name="qtd_temporadas" id="qtd_temporadas" min="1">
            </div>


            <div class="col col-2">
                <label for="name">Episódios:</label>
                <input type="number" class="form-control mb-2" name="ep_por_temporada" id="ep_temporada" min="1">
            </div>
        </div>

        <button class="btn btn-success mt-2">Adicionar</button>
        <a href="{{route('listar_series')}}">
            <div class="btn btn-primary mt-2">
                Listar Séries
            </div>
        </a>
    </form>
@endsection

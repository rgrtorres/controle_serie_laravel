@extends('layout')

@section('cabecalho')
    Entrar
@endsection

@section('conteudo')
    @include('erros', ['errors' => $errors])
    <form action="" method="post">
        @csrf
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Logar</button>

        <a href="{{route('usuario_registrar')}}" class="btn btn-secondary mt-3">Registre-se</a>
    </form>
@endsection

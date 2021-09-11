<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Séries</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark mb-5">
        <div class="container">
            <a href="{{route('listar_series')}}" class="navbar-brand">Home</a>

            <div class="d-flex justify-content-between">
                @auth
                    <a href="/usuario/sair" class="btn btn-danger">Logout</a>
                @endauth

                @guest()
                    <a href="/usuario/logar" class="btn btn-primary">Logar</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="jumbotron">
            <h1>@yield('cabecalho')</h1>
        </div>

        @yield('conteudo')
    </div>
</body>
</html>

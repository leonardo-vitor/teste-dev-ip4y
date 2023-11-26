<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste para vaga de desenvolvedor iP4y</title>

    @vite('resources/css/bootstrap.css')
</head>
<body>

<div class="p-3 bg-body-secondary rounded-0">
    <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold text-center mb-4">Teste para vaga de desenvolvedor iP4y</h1>

        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-lg-5">
                <nav class="navbar navbar-expand-sm bg-body-tertiary rounded">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav text-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register.list') }}">
                                        Registros
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register.create') }}">
                                        Novo registro
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register.sendAll') }}">
                                        JSON
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container bg-white py-5">
    @yield('content')
</div>

@vite('resources/js/bootstrap.bundle.js')
@vite('resources/js/app.js')
</body>
</html>

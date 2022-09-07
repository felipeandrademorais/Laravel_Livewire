<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('pessoa') }}">Prova PHP IST</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pessoa') }}">Pessoa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('conta') }}">Conta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('movimentacao') }}">Movimentação</a>
            </li>
        </ul>
    </div>
    </nav>
</header>
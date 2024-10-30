<div class="sidebar">
    <div class="sidebarHeader">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="48px"></span>
        <a href="https://github.com/reposeek" target="_blank" class="btn btn-secondary"><span><i class="bi bi-question-circle"></i> Sobre</span></a>
    </div>

    <hr>

    <div class="sidebarMenu">
        <div class="menuTitle fs-4 mb-4">Projeto Recentes</div>
        <div class="menuBody">
            @if(Auth::user() != null)
                @foreach(Auth::user()->projetos as $projeto)
                    <a href="{{ route('repo.show', ['id' => $projeto->id])}}">
                        <div class="menuItem">{{ $projeto->name }}</div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <div class="userArea">
        @if(Auth::user() != null)
            <div class="userName"><i class="bi bi-person-fill"></i> {{ Auth::user()->name }}</div>
            <a href="{{ route('logout') }}" class="btn btn-secondary">Sair</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
        @endif
    </div>
</div>
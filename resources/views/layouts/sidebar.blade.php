<div class="sidebar">
    <div class="sidebarHeader">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="48px"></span>
        <span><i class="bi bi-chevron-bar-left"></i></span>
    </div>

    <span class="btn btn-secondary sobre"><i class="bi bi-info-circle"></i> Sobre</span>

    <div class="sidebarMenu">
        <div class="menuTitle">Projeto Recentes</div>
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
<div class="sidebar">
    <div class="sidebarHeader">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="48px"></span>
        <span><i class="bi bi-chevron-bar-left"></i></span>
    </div>

    <span class="btn btn-secondary sobre"><i class="bi bi-info-circle"></i> Sobre</span>

    <div class="sidebarMenu">
        <div class="menuTitle">Projeto Recentes</div>
        <div class="menuBody">
            <div class="menuItem">Projeto 1</div>
            <div class="menuItem">Projeto 2</div>
            <div class="menuItem">Projeto 3</div>
        </div>
    </div>

    <div class="userArea">
        @if(Auth::user() != null)
            <div class="userName"><i class="bi bi-person-fill"></i> {{ Auth::user()->name }}</div>
            <a href="{{ route('logout') }}" class="btn btn-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
        @endif
    </div>
</div>
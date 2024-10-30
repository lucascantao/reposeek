<div class="sidebar">
    <div class="sidebarHeader">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="48px"></span>
        <div>
            
            <a href="https://github.com/lucascantao/reposeek" target="_blank" class="btn"><span><i class="bi bi-question-circle"></i></span></a>
            <a href="{{ route('repo.index') }}" class="btn"><span><i class="bi bi-pencil-square"></i></span></a>
        </div>
    </div>
    <hr>
    <div class="sidebarMenu">
        <div class="menuTitle fs-4 mb-4">Projeto Recentes</div>
        <div class="menuBody">
            @if(Auth::user() != null)
                @foreach(Auth::user()->projetos as $projeto)
                    <div class="menuItem">
                        <span>{{ substr($projeto->description, 0, 20).'...' }}</span>
                        <div>
                            <a href="{{ route('repo.show', ['id' => $projeto->id])}}" class="btn btn-outline-secondary me-1"><i class="bi bi-box-arrow-up-right"></i></a>
                            <a href="{{ route('repo.delete', ['id' => $projeto->id])}}" class="btn btn-outline-secondary"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
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
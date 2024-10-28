@extends('layouts.app')
@section('content')

<div class="sidebar">
    <div class="sidebarHeader">
        <span><img src="/images/icons/riot-games.png" alt="" height="48px"></span>
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
</div>

<div class="chatContainer">
    <div class="title"><span>Reposeek</span></div>
    <div class="logoContainer">
        <span><img src="/images/icons/riot-games.png" alt="" height="128px"></span>
    </div>
    <div class="chat">
        <form action="{{ route('repo.searchRepositories') }}" method="post">
            @csrf()
            @method('post')
            <textarea type="text" class="form-control chatText" name="descricaoProjeto" rows="5" placeholder="Digite aqui os requisitos ou uma descrição do seu projeto..."></textarea>

            <button type="submit" class="btn btn-secondary">
                <i class="bi bi-send-fill"></i>
            </button>
        </form>
    </div>
</div>
@endsection
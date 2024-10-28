@extends('layouts.app')
@section('content')
<div class="chatContainer">
    <div class="appTitle"><span>Reposeek</span></div>
    <div class="logoContainer">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="128px"></span>
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
@extends('layouts.app')
@section('content')

<div class="chatContainer">
    <div class="appTitle"><span>Reposeek</span></div>
    <div class="logoContainer">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="128px"></span>
    </div>

    <div class="chatContainer">

        <div class="userText">
            {{ $description }}
        </div>

        <div class="systemText">
            Vi aqui que seu projeto se encaixa nas seguintes categorias:
            <ul>
                <li class="category">
                    Funcionalidade: <i>{{  $categories[1] }}</i>
                </li>
                <li class="category">
                    Domínio: <i>{{  $categories[2] }}</i>
                </li>
                <li class="category">
                    Arquitetura: <i>{{  $categories[3] }}</i>
                </li>
                <li class="category">
                    Interação: <i>{{  $categories[4] }}</i>
                </li>
            </ul>
            <br>
            Selecionei alguns repositórios que tenham haver com o objetivo do seu sistema.
        </div>

        <div class="repositories">
    
            @foreach($repositories as $repository)
                <div class="repository">
                    <div class="header">
                        <div class="title">{{ $repository['name'] }} <span class="owner"> | by <i> <a href="{{ $repository['owner']['html_url'] }}" target="_blank">{{ $repository['owner']['login'] }}</a></i></span> </div>
                    </div>
                    <div class="description">{{ substr($repository['description'], 0, 120).'...' }}</div>
    
                    <div class="actions">
                        <a href="https://github.com/{{ $repository['full_name'] }}" target="_blank"><i class="bi bi-box-arrow-up-right"></i></a>
                    </div>
                </div>
            @endforeach
    
        </div>
    </div>

</div>
@endsection
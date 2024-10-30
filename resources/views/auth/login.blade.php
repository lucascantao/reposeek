@extends('layouts.guest')
@section('authentication')
    
<div class="container form-container">
    <div class="form-box">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="48px" style="display: block;
margin-left: auto;
margin-right: auto;"><h3 class="text-center mb-4">Login</h3></span>
        
        <form action="{{ route('login') }}" method="post">
            @csrf
            @method('post')
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu email" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            <a href="{{ route('register') }}" class="btn btn-secondary btn-block">Registrar</a>
        </form>
    </div>
</div>

@endsection
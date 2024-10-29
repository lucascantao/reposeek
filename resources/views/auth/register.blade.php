@extends('layouts.guest')
@section('authentication')
<div class="container form-container">
    <div class="form-box">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="48px"><h3 class="text-center mb-4">Login</h3></span>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Nome</label>
                    <input type="name" class="form-control" name="name" id="name" placeholder="Digite seu nome" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Confirmar Senha</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirme sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            </form>
        </div>
    </div>
@endsection

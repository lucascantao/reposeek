@extends('layouts.app')
@section('content')

<div class="ContainerFormDescricao">
    <form action="{{ route('repo.searchRepositories') }}" method="post">
        @csrf()
        @method('post')
        <div class="mb-3">
            <label for="descricaoProjeto" class="form-label">Descrição do Projeto</label>
            <textarea type="text" class="form-control" name="descricaoProjeto" rows="5" placeholder="Digite aqui os requisitos ou uma descrição do seu projeto..."></textarea>
        </div>
    
        <input class="btn btn-primary" type="submit" value="Submeter">
    
    </form>
</div>
@endsection
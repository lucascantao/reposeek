@php
    $config = Auth::user()->perfil->rotas()->where('rotas.endpoint', $endpoint)->first();
@endphp

@if($config != null && !$config->pivot->read)
    <i class="bi bi-lock-fill" style="color: var(--app-secondary)"></i>
@endif

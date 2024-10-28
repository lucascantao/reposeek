@extends('layouts.app')
@section('content')

<div class="chatContainer">
    <div class="appTitle"><span>Reposeek</span></div>
    <div class="logoContainer">
        <span><img src="/images/icons/reposeek-logo.png" alt="" height="128px"></span>
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
@endsection
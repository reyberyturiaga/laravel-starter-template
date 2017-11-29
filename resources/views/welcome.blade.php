@extends('_layouts.app', ['page' => 'welcome-page'])

@section('header')

@stop

@section('navigation')
<div class="welcome-page__navigation">
    @auth
    <a href="{{ route('home') }}" class="welcome-page__links">Home</a>
    @endauth

    @guest
    <a href="{{ route('login') }}" class="welcome-page__links">Login</a>
    <a href="{{ route('register') }}" class="welcome-page__links">Register</a>
    @endguest
</div>
@stop

@section('content')
<div class="welcome-page__content">
    <div class="welcome-page__title">
        Laravel
    </div>

    <div>
        <a href="https://laravel.com/docs" class="welcome-page__links">Documentation</a>
        <a href="https://laracasts.com" class="welcome-page__links">Laracasts</a>
        <a href="https://laravel-news.com" class="welcome-page__links">News</a>
        <a href="https://forge.laravel.com" class="welcome-page__links">Forge</a>
        <a href="https://github.com/laravel/laravel" class="welcome-page__links">GitHub</a>
    </div>
</div>
@stop

@section('sidebar')

@stop

@section('footer')

@stop

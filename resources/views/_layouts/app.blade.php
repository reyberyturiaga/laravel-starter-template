<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- Document Character Set Encoding -->
    <meta charset="UTF-8">

    <!-- IE Edge Compatibility Mode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Responsive Viewport Scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Document Title -->
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    @include('_assets.fonts')

    <!-- Icons -->
    @include('_assets.icons')

    <!-- Imports -->
    @include('_assets.imports')

    <!-- Metadata -->
    @include('_assets.meta')

    <!-- Styles -->
    @include('_assets.styles')
</head>
<body class="{{ $page ?? '' }}">
    <div id="app">
        @section('header')
            @include('_layouts.header')
        @show

        @section('navigation')
            @include('_layouts.navigation')
        @show

        @yield('content')

        @section('sidebar')
            @include('_layouts.sidebar')
        @show

        @section('footer')
            @include('_layouts.footer')
        @show
    </div>

    <!-- Scripts -->
    @include('_assets.scripts')
</body>
</html>

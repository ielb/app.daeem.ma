<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    {{-- sidebar --}}
    @include('includes.sidebar')
    <div class="main-content" id="panel">
        {{-- navbar --}}
        @include('includes.nav')
        <!-- Header -->
        <div class="header pb-6" style="background-color:#{{ env('color_head') }}">
            @yield('header')
        </div>
        {{-- page content --}}
        <div class="container-fluid mt--6">
            {{-- content --}}
            @yield('content')
            {{-- footer --}}
            {{-- @include('includes.footer') --}}
        </div>
    </div>
    {{-- script --}}
    @include('includes.scripts')
    @yield('scripts')
    @include('partials.notification')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <style>
    svg:not(:root) {
  overflow: hidden;
  display: none !important;
}
</style>
        @section('head')
        @include('include.head')
        @show
        @stack('page-css')
    </head>
    <body >
        <div class="container-fluid bg-white">
            
            <div class="row" style="height:750px;">
                <div class="wrapper">
                @section('nav')
        @include('include.nav')
        @show
                @yield('content')
                </div>
                
            </div>
        @section('footer')
        @include('include.footer')
        @show    
        </div>
        
        @section('footer-js')
        @include('include.footer-js')
        @show
        @stack('page-js')
    </body>
</html>

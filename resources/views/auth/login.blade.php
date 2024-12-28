@extends('layouts.app')
@section('nav')
@stop
@section('content')
<div class="col-md-6 ">
    <div class="text-center pt-5" style="margin-top:15%;">
        <img class="mb-4 img-fluid rounded" src="{!! asset('asset/losgo.png') !!}" alt="LOGO">
    </div>
    <div class="text-center">
        <p class="text-dark">
            Dextro Solution is a Technology and IT-based globally firm where we provide all kind of facilities related to technology and IT. Dextro Solution is Google Certified company. It has been working since 2010 in the field of IT. Since then we work hard to earn a good name in the national and international markets. We have strong bonding and relation with our clients, which help us to understand their demands and ideas.</p>
    </div>
</div>
<div class="col-md-6 greenc">
    <div class="text-center pt-5 pb-5" style="margin-top:15%;">
        <form action="{!! route('login') !!}" method="post" class="form-signin  bg-white rounded" enctype="multipart/form-data" data-toggle="validator" autocomplete="off">
            @csrf
            <h5 class="text-dark font-weight-bold text-left mb-3">Login to your account</h5>
            <div class="form-group input-container">
                <i class="fa fa-user icon pt-3"></i>
                <input type="email" class="form-control rounded-0 input-field" autocomplete="off" placeholder="Email" name="email" required>
            </div>

            <div class="form-group input-container">
                <i class="fa fa-key icon pt-3"></i>
                <input type="password" class="form-control rounded-0 input-field" autocomplete="off" name="password" placeholder="Password" required>
            </div>
            <div class="checkbox mb-3 fa-pull-left">
                <label>
                    <input type="checkbox" checked value="remember-me">
                    Remember me </label>
            </div>
            <button class="btn btn-lg btn-dark greenc rounded-0 btn-block border-0" name="login" type="submit">Login</button>
            <a class="btn btn-lg btn-dark bg-dark rounded-0 btn-block border-0" href=""> Forgot Password</a>
        </form>
        @stop
        @section('footer')
        @stop
        @php /*
        <x-guest-layout>
            <x-auth-card>
                <x-slot name="logo">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </x-slot>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />

                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif

                        <x-primary-button class="ml-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-auth-card>
        </x-guest-layout>
        */@endphp
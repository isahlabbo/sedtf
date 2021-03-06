
@extends('layouts.minimal')
@section('title')
    SEDTF-Student lonin
@endsection
@section('page-content')
    <br><br>
    <section class="">
        <div class="grid-row">
            <div class="login-block">
                <div class="logo">
                    <img src="{{asset('img/logo.png')}}" data-at2x='img/logo@2x.png' alt>
                    <h2>Student Login</h2>
                </div>
                <form class="login-form">
                    <div class="form-group">
                        <input type="text" class="login-input" placeholder="Username">
                        <span class="input-icon">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="login-input" placeholder="Pasword">
                        <span class="input-icon">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <br>
                    <p class="">
                        <a href="{{ route('password.request') }}">Forgot Password ?</a>
                    </p>
                    <button class="button-fullwidth cws-button bt-color-3 alt">{{ __('Login') }}</button>
                    
                    <a href="{{route('welcome')}}" class="button-fullwidth cws-button bt-color-3">Home</a>
                </form>
            </div>
        </div>
    </section>
@endsection    
<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="mdl-card mdl-shadow--2dp login-card">
        <div class="mdl-card__title" style="background: #3f51b5;">
            <h2 class="mdl-card__title-text" style="color: white;">Login Sistem</h2>
        </div>
        <div class="mdl-card__supporting-text">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ old('email') }}" required>
                    <label class="mdl-textfield__label" for="email">Email</label>
                    @error('email')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="password" id="password" name="password" required>
                    <label class="mdl-textfield__label" for="password">Password</label>
                    @error('password')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="width: 100%;">
                    Login
                </button>
                
                <div style="margin-top: 20px; text-align: center;">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.auth')

@section('content')

<div class="form-v4-content">
    <div class="form-left">
        <h2 class="logo">
                <img class="logo"
                src="{{ env('APP_LOGO') ? url('storage/' . env('APP_LOGO')) : url('assets/media/image/logo.png') }}">
        </h2>
        <h3>Hello, Friend!</h3>
        <p class="text-1">don't have an account ? Enter your personal details and start journey with us.</p>

        <div class="form-left-last">
            <a class="account" href="{{ route('register') }}">Register</a>
        </div>

    </div>
    <form class="form-detail" method="POST" action="{{ route('login') }}" id="myform">
        @csrf

        <h2>Login Form</h2>

        <div class="form-row">
            <label for="login">Username or Email</label>
            <input type="text" name="login" id="login" class="input-text" required>
        </div>
        <div class="form-row">
            <label for="password">Password</label>
                <input type="password" name="password" id="password" class="input-text" required>
        </div>

        <div class="form-row">
            @error('username')
            <label id="your_email-error" class="error" for="your_email">{{ $message }}.</label>
            @enderror
        </div>

        <div class="form-row-last">
            <button type="submit" class="register">Login</button>
        </div>

        <div class="form-row">
            <a class="reset" href="{{ route('password.request') }}">Forgot password</a>
        </div>

    </form>


</div>

@endsection
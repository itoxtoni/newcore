@extends('layouts.auth')

@section('content')

<div class="form-v4-content">
    <div class="form-left">
        <h2 class="logo">
                <img class="logo"
                src="{{ env('APP_LOGO') ? url('storage/' . env('APP_LOGO')) : url('assets/media/image/logo.png') }}">
        </h2>
        <h3>Welcome Back!</h3>
        <p class="text-1">To keep connected with us please login with your personal info.</p>

        <div class="form-left-last">
            <a class="account" href="{{ route('login') }}">Login</a>
        </div>


    </div>
    <form class="form-detail" method="POST" action="{{ route('register') }}" id="myform">
        @csrf

        <h2>Register Form</h2>

        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="input-text" required>
        </div>

        <div class="form-row">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="input-text" required>
        </div>

        <div class="form-row">
            <label for="password">Password</label>
                <input type="password" name="password" id="password" class="input-text" required>
        </div>

        <div class="form-row">
            <label for="password-confirm">Confirm Password</label>
                <input type="password" name="password-confirm" id="password-confirm" class="input-text" required>
        </div>

        <div class="form-row-last">
            <button type="submit" class="register">Save</button>
        </div>
    </form>

</div>

@endsection
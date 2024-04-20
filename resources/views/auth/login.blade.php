@extends('layout')

@section('content')
<!-- Reusable header component -->
<header class="custom-header d-flex justify-content-between align-items-center">
    <!-- Header content goes here -->
    <div class="header-content">
        <img src="/storage/Dacumos.png" alt="Dacumos Logo">
    </div>
    <!-- Add a link to register page -->
    <div>
        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
    </div>
</header>
<!-- Login form -->
<div class="row justify-content-center mt-5">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header text-center">
                <h3>Login Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

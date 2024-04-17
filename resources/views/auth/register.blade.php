@extends('layouts.app')

@section('content')
<!-- Reusable header component -->
<header class="custom-header d-flex justify-content-between align-items-center">
    <!-- Header content goes here -->
    <div class="header-content">
        <img src="/storage/Dacumos.png" alt="Dacumos Logo">
    </div>
    <!-- Add a link to register page -->
    <div>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
</header>
<!-- Register form -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Register Form</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        </div>
                        
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

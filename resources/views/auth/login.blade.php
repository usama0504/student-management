@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <style>
        .login-card {
            width: 100%;
            height: 430px;
            max-width: 400px;
            border: none;
            border-radius: 14px;
        }

        .login-card .card-body {
            padding: 28px !important;
        }

        .login-title {
            font-size: 26px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            margin-bottom: 5px;
        }

        .form-control {
            padding: 10px 12px;
            border-radius: 8px;
        }

        .login-btn {
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>

    <div class="auth-wrapper">

        <div class="card login-card shadow">
            <div class="card-body">

                <div class="text-center mb-3">
                    <h2 class="login-title mb-1">Welcome Back</h2>
                    <p class="text-muted mb-0">Login to your account</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success py-2">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label fw-semibold">Email</label>

                        <input type="email" name="email" class="form-control" placeholder="Enter your email"
                            value="{{ old('email') }}">

                        @error('email')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Password</label>

                        <input type="password" name="password" class="form-control" placeholder="Enter your password">

                        @error('password')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark w-100 login-btn">
                        Login
                    </button>
                </form>

                <div class="text-center mt-3">
                    <span class="text-muted">Don't have an account?</span>
                    <a href="/register" class="text-decoration-none fw-semibold">
                        Register
                    </a>
                </div>

            </div>
        </div>

    </div>

@endsection

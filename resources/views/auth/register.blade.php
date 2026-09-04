@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    <style>
        .register-card {
            width: 100%;
            max-width: 360px;
            border: none;
            border-radius: 12px;
        }

        .register-card .card-body {
            padding: 20px !important;
        }

        .register-title {
            font-size: 23px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-label {
            margin-bottom: 4px;
        }

        .form-control {
            padding: 7px 11px;
            border-radius: 7px;
        }

        .register-btn {
            padding: 8px;
            border-radius: 7px;
            font-weight: 600;
        }
    </style>

    <div class="auth-wrapper">

        <div class="card register-card shadow">
            <div class="card-body">

                <div class="text-center mb-3">
                    <h2 class="register-title mb-1">Create Account</h2>
                    <!-- <p class="text-muted mb-0">Register your account</p> -->
                </div>

                <form action="/register" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label fw-semibold">Name</label>

                        <input type="text" name="name" class="form-control" placeholder="Enter your name"
                            value="{{ old('name') }}">

                        @error('name')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

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

                    <div class="form-group">
                        <label class="form-label fw-semibold">Password</label>

                        <input type="password" name="password" class="form-control" placeholder="Enter your password">

                        @error('password')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Confirm Password</label>

                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm your password">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 register-btn">
                        Register
                    </button>
                </form>

                <div class="text-center mt-3">
                    <span class="text-muted">Already have an account?</span>
                    <a href="/login" class="text-decoration-none fw-semibold">
                        Login
                    </a>
                </div>

            </div>
        </div>

    </div>

@endsection

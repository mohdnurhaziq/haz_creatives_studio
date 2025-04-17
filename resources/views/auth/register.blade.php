@extends('layouts.template')

@section('title', 'Register - Haz Creatives Studio')

@section('content')
    <main class="main" style="background-color: rgba(0, 0, 0, 0.9); min-height: 100vh; padding: 40px 0;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4" style="margin-top: 120px;">
                    <h2 class="text-center text-white mb-4">Register</h2>
                    <div class="card" style="background: rgba(255, 255, 255, 0.95); border-radius: 10px;">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text"
                                        class="form-control bg-light @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus
                                        style="padding: 12px; border-radius: 5px; border: 1px solid #dee2e6;">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input id="email" type="email"
                                        class="form-control bg-light @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        style="padding: 12px; border-radius: 5px; border: 1px solid #dee2e6;">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password"
                                        class="form-control bg-light @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password"
                                        style="padding: 12px; border-radius: 5px; border: 1px solid #dee2e6;">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password-confirm" class="form-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control bg-light"
                                        name="password_confirmation" required autocomplete="new-password"
                                        style="padding: 12px; border-radius: 5px; border: 1px solid #dee2e6;">
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-dark"
                                        style="padding: 12px; font-weight: 500; border-radius: 5px;">
                                        Register
                                    </button>
                                </div>

                                <div class="text-center">
                                    <a class="text-decoration-none text-success" href="{{ route('login') }}">
                                        Already have an account? Login
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

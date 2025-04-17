@extends('layouts.template')

@section('title', 'Admin Login - Haz Creatives Studio')

@section('content')
    <main class="main" style="background-color: rgba(0, 0, 0, 0.9); min-height: 100vh; padding: 40px 0;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4" style="margin-top: 120px;">
                    <h2 class="text-center text-white mb-4">Admin Login</h2>
                    <div class="card" style="background: rgba(255, 255, 255, 0.95); border-radius: 10px;">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input id="email" type="email"
                                        class="form-control bg-light @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
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
                                        name="password" required autocomplete="current-password"
                                        style="padding: 12px; border-radius: 5px; border: 1px solid #dee2e6;">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }} style="border-color: #dee2e6;">
                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-dark"
                                        style="padding: 12px; font-weight: 500; border-radius: 5px;">
                                        Login
                                    </button>
                                </div>

                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a class="text-decoration-none text-success" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

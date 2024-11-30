@extends('layouts.auth')
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-danger">
            <div class="card-header text-center">
                <a href="/" class="h1 text-danger"><b>Login</b></a>
            </div>
            <div class="card-body">
                @if (session('error') || session('success'))
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @else
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                @else
                    <p class="login-box-msg">Sign in to start your session</p>
                @endif
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="text" id="username"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="far fa-user"></span>
                                </div>
                            </div>
                            @error('username')
                                <span id="username" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span id="password" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-danger">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-danger btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <div class="card-footer">
                <div class="social-auth-links text-left">
                    Don't have an account?
                    <strong>
                        <a href="{{ route('register') }}">Register</a>
                    </strong>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

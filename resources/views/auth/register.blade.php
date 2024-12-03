@extends('layouts.auth')
@section('content') 
    <div class="login-box"> 
        <!-- /.login-logo -->
        <div class="card card-outline card-danger">
            <div class="card-header text-center">
                <a href="/" class="h1 text-danger"><b>Register</b></a>
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
                    <p class="login-box-msg">Register a new membership</p>
                @endif
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" id="fullname"
                                class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                placeholder="Fullname">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="far fa-user"></span>
                                </div>
                            </div>
                            @error('fullname')
                                <span id="fullname" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span id="email" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" id="username"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                            @error('username')
                                <span id="username" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" placeholder="Phone Number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            @error('phone')
                                <span id="phone" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" id="confirm_password"
                                class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password"
                                placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('confirm_password')
                                <span id="confirm_password" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <select id="commuting_method_id"
                            class="form-control select2bs4 @error('commuting_method_id') is-invalid @enderror"
                            style="width: 100%;" name="commuting_method_id">
                            <option value="">-- Select Commuting Methods --</option>
                            @foreach ($cm as $item)
                                <option value="{{ $item->id }}" 
                                    {{ old('commuting_method_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                        </select> 
                        @error('commuting_method_id')
                            <span id="commuting_method_id" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div> 
                    <div class="form-group">
                        <select id="energy_source_id"
                            class="form-control select2bs4 @error('energy_source_id') is-invalid @enderror"
                            style="width: 100%;" name="energy_source_id">
                            <option value="">-- Select Energy Source --</option>
                            @foreach ($es as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('energy_source_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach 
                        </select>
                        @error('energy_source_id')
                            <span id="energy_source_id" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select id="dietary_preference_id"
                            class="form-control select2bs4 @error('dietary_preference_id') is-invalid @enderror"
                            style="width: 100%;" name="dietary_preference_id">
                            <option value="">-- Select Dietary Preferences --</option>
                            @foreach ($dp as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('dietary_preference_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('dietary_preference_id')
                            <span id="dietary_preference_id" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-danger btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div> 
                </form>
            </div>
            <div class="card-footer"> 
                <div class="social-auth-links text-left mt-2 mb-3">
                    Already have an account? <strong><a href="{{ route('login') }}">Login</a></strong>
                </div>
            </div> 
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

@extends('layouts.index')
@section('title')
    <strong>
        Edit Profile
    </strong>
@endsection


@section('content')
    <div class="col-12">
        <form method="POST" action="{{ route('profile.update', $profile->id) }}">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('profile.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $profile->name) }}">
                                @error('name')
                                    <span id="name" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $profile->email) }}">
                                @error('email')
                                    <span id="email" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username', $profile->username) }}">
                                @error('username')
                                    <span id="username" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!--end of username-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $profile->phone) }}">
                                @error('phone')
                                    <span id="phone" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!--end of phone number-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="commuting_method_id">Commuting Method</label>
                                <select id="commuting_method_id"
                                    class="form-control select2bs4 @error('commuting_method_id') is-invalid @enderror"
                                    style="width: 100%;" name="commuting_method_id">
                                    <option value="">-- Select Commuting Methods --</option>
                                    @foreach ($cm as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('commuting_method_id', $profile->userDetail->commuting_method_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('commuting_method_id')
                                    <span id="commuting_method_id" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!--end of Commuting Method-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dietary_preference_id">Dietary Preference</label>
                                <select id="dietary_preference_id"
                                    class="form-control select2bs4 @error('dietary_preference_id') is-invalid @enderror"
                                    style="width: 100%;" name="dietary_preference_id">
                                    <option value="">-- Select Dietary Preferences --</option>
                                    @foreach ($dp as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('dietary_preference_id', $profile->userDetail->dietary_preference_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dietary_preference_id')
                                    <span id="dietary_preference_id" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!--end of Dietary Preference-->
                    </div><!--end of row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="energy_source_id">Energy Source</label>
                                <select id="energy_source_id"
                                    class="form-control select2bs4 @error('energy_source_id') is-invalid @enderror"
                                    style="width: 100%;" name="energy_source_id">
                                    <option value="">-- Select Energy Source --</option>
                                    @foreach ($es as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('energy_source_id', $profile->userDetail->energy_source_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('energy_source_id')
                                    <span id="energy_source_id" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

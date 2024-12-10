@extends('layouts.index')
@section('title')
    <strong>
        Create Activity Log
    </strong>
@endsection


@section('content')
    <div class="col-12">
        <form method="POST" action="{{ route('al.store') }}">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('al.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" name="date" value="{{ old('date') }}">
                                @error('date')
                                    <span id="date" class="error invalid-feedback">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dietary_preference_id">Dietary Preference</label>
                                <select id="dietary_preference_id"
                                    class="form-control select2bs4 @error('dietary_preference_id') is-invalid @enderror"
                                    style="width: 100%;" name="dietary_preference_id">
                                    <option value="">-- Select Dietary Preferences --</option>
                                    @foreach ($dp as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('dietary_preference_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dietary_preference_id')
                                    <span id="dietary_preference_id" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="commuting_method_id">Commuting Method</label>
                                <select id="commuting_method_id"
                                    class="form-control select2bs4 @error('commuting_method_id') is-invalid @enderror"
                                    style="width: 100%;" name="commuting_method_id">
                                    <option value="">-- Select Commuting Methods --</option>
                                    @foreach ($cm as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('commuting_method_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('commuting_method_id')
                                    <span id="commuting_method_id" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="commuting_method_value">Commuting Method Value (in KM)</label>
                                <input type="number" class="form-control @error('commuting_method_value') is-invalid @enderror"
                                    id="commuting_method_value" name="commuting_method_value"
                                    value="{{ old('commuting_method_value') }}">
                                @error('commuting_method_value')
                                    <span id="commuting_method_value" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="energy_source_id">Energy Source</label>
                                <select id="energy_source_id"
                                    class="form-control select2bs4 @error('energy_source_id') is-invalid @enderror"
                                    style="width: 100%;" name="energy_source_id">
                                    <option value="">-- Select Energy Source --</option>
                                    @foreach ($es as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('energy_source_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('energy_source_id')
                                    <span id="energy_source_id" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="energy_source_value">Energy Source Value (in kWh)</label>
                                <input type="number" class="form-control @error('energy_source_value') is-invalid @enderror"
                                    id="energy_source_value" name="energy_source_value"
                                    value="{{ old('energy_source_value') }}">
                                @error('energy_source_value')
                                    <span id="energy_source_value" class="error invalid-feedback">{{ $message }}</span>
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

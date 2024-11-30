@extends('layouts.index')
@section('title')
    <strong>
        Edit Energy Source
    </strong>
@endsection


@section('content')
    <div class="col-12">
        <form method="POST" action="{{ route('es.update', $es->id) }}">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('es.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="ex: Solar, Hydro." name="name"
                                    value="{{ old('name', $es->name) }}">
                                @error('name')
                                    <span id="name" class="error invalid-feedback">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="value">Value</label>
                                <input type="number" min="0" step="0.01"
                                    class="form-control @error('value') is-invalid @enderror" id="value"
                                    placeholder="ex: 0.01, 0.1 ,1" name="value" value="{{ old('value', $es->value) }}">
                                @error('value')
                                    <span id="value" class="error invalid-feedback">{{ $message }}</span>
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

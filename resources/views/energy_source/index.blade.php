@extends('layouts.index')
@section('title')
    <strong>
        Energy Source
    </strong>
@endsection


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('es.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Energy Source</a>
            </div>
        </div>
        <div class="card-body">
            <table class="example2 table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th class="text-center">Value</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($energy_sources as $key => $energy_source)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $energy_source->name }}</td>
                            <td class="text-center">{{ $energy_source->value }}</td>
                            <td class="text-end">
                                <a href="{{ route('es.edit', $energy_source->id) }}" class="btn btn-warning">Edit</a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
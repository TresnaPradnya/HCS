@extends('layouts.index')
@section('title')
    <strong>
        Commuting Method
    </strong>
@endsection


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('cm.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Commuting Method</a>
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
                    @foreach ($cm as $key => $energy_source)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $energy_source->name }}</td>
                            <td class="text-center">{{ $energy_source->value }}</td>
                            <td class="text-end">
                                <a href="{{ route('cm.edit', $energy_source->id) }}" class="btn btn-warning">Edit</a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
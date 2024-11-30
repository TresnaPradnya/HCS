@extends('layouts.index')
@section('title')
    <strong>
        Dietary Preference
    </strong>
@endsection


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('dp.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Dietary Preference</a>
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
                    @foreach ($dp as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">{{ $item->value }}</td>
                            <td class="text-end">
                                <a href="{{ route('dp.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
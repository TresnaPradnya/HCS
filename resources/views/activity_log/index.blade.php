@extends('layouts.index')
@section('title')
    <strong>
        Daily Activity Log
    </strong>
@endsection


@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{ route('al.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Activity</a>
                </div>
            </div>
            <div class="card-body">
                <table class="example2 table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Date</th>
                            <th>Commuting Method</th>
                            <th>CM Value</th>
                            <th>Energy Source</th>
                            <th>ES Value</th>
                            <th>Diet Preference</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activity_logs as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->commutingMethod->name }}</td>
                                <td>{{ $item->commuting_method_value }}</td>
                                <td>{{ $item->energySource->name }}</td>
                                <td>{{ $item->energy_source_value }}</td>
                                <td>{{ $item->dietaryPreference->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('al.edit', $item->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('al.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

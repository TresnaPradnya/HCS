@extends('layouts.index')

@section('title', 'Educational Content')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Educational Content</h3>
                <div class="card-tools d-flex">
                    <!-- Form untuk pencarian -->
                    <form method="GET" action="{{ route('educational-contents.index') }}" class="form-inline">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by title or description" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('educational-contents.create') }}" class="btn btn-primary ml-2">
                        <i class="fas fa-upload"></i> Upload Content
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File</th>
                                <th>Uploaded At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contents as $key => $content)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $content->title }}</td>
                                    <td>{{ $content->description }}</td>
                                    <td>
                                        <a href="{{ route('educational-contents.download', $content->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </td>
                                    <td>{{ $content->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No content available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

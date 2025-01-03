@extends('layouts.index')

@section('title', 'Create Post')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create a New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" id="postForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="start_date" value="{{ $startDate }}">
        <input type="hidden" name="end_date" value="{{ $endDate }}">
        <input type="hidden" name="transportation_footprint" value="{{ $transportation_footprint }}">
        <input type="hidden" name="energy_footprint" value="{{ $energy_footprint }}">
        <input type="hidden" name="diet_footprint" value="{{ $diet_footprint }}">
        <input type="hidden" name="total_footprint" value="{{ $total_footprint }}">
        <input type="hidden" name="pie_chart_image" value="{{ $pieChartImage }}">
        <input type="hidden" name="line_chart_image" value="{{ $lineChartImage }}">

        <div class="form-group">
            <label for="content">Caption:</label>
            <textarea name="content" id="content" class="form-control" rows="3" placeholder="Write a caption..." maxlength="255"></textarea>
        </div>

        <div class="form-group">
            <label for="visibility">Post Visibility:</label>
            <select name="visibility" id="visibility" class="form-control">
                <option value="public">Public (visible to everyone)</option>
                <option value="private">Private (visible only to you)</option>
            </select>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Transportation</h5>
                        <h3 class="text-primary">{{ $transportation_footprint }} kg CO₂</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Energy</h5>
                        <h3 class="text-success">{{ $energy_footprint }} kg CO₂</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Diet</h5>
                        <h3 class="text-danger">{{ $diet_footprint }} kg CO₂</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Footprint (System Response: Overall Footprint Calculation) -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Carbon Footprint</h5>
                        <h3 class="text-info">{{ $total_footprint }} kg CO₂</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chart Previews -->
        <div class="form-group">
            <h5>Charts Preview</h5>
            <div class="d-flex justify-content-start gap-3 mb-3">
                @if ($pieChartImage)
                    <img src="{{ $pieChartImage }}" alt="Pie Chart" class="img-fluid" style="max-width: 200px; height: auto;">
                @else
                    <p>No pie chart available.</p>
                @endif

                @if ($lineChartImage)
                    <img src="{{ $lineChartImage }}" alt="Line Chart" class="img-fluid" style="max-width: 200px; height: auto;">
                @else
                    <p>No line chart available.</p>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success">Submit Post</button>
    </form>
</div>
@endsection

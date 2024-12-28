@extends('layouts.index')
@section('title')
    <strong>
        Carbon Footprint Dashboard 
    </strong>
@endsection

@section('content')
<div class="container mt-5">

    <!-- Date Range Picker Section (Actor Action) -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('home') }}" method="GET" class="form-inline">
                <label for="start_date" class="mr-2">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="form-control mr-2" value="{{ $startDate }}">
                <label for="end_date" class="mr-2">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="{{ $endDate }}">
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('recommendation.index') }}" method="GET" class="form-inline d-inline-block" id="recommendationForm">
                <input type="hidden" name="start_date" id="hiddenStartDate" value="{{ $startDate }}">
                <input type="hidden" name="end_date" id="hiddenEndDate" value="{{ $endDate }}">
                <button type="submit" class="btn btn-success" id="recommendationButton">Get Recommendation</button>
            </form>
        </div>
    </div>

    <!-- System Response: Summary of Footprints (Breakdown) -->
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

    <!-- Charts Section -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Carbon Footprint Breakdown</h5>
                    <canvas id="footprintPieChart"></canvas> <!-- Pie Chart Canvas -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Historical Trends</h5>
                    <canvas id="footprintLineChart"></canvas> <!-- Line Chart Canvas -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the Pie Chart
        const pieChartData = {
            labels: ['Transportation', 'Energy', 'Diet'],
            datasets: [{
                data: [
                    {{ $transportation_footprint }},
                    {{ $energy_footprint }},
                    {{ $diet_footprint }}
                ],
                backgroundColor: ['#007bff', '#28a745', '#dc3545']
            }]
        };

        // Pie Chart Configuration
        const pieChartConfig = {
            type: 'pie',
            data: pieChartData
        };

        // Render Pie Chart
        const footprintPieChart = new Chart(document.getElementById('footprintPieChart'), pieChartConfig);

        // Data for the Line Chart (Historical Trends)
        const lineChartData = {
            labels: @json($dates->toArray()),  // Convert to array before passing
            datasets: [{
                label: 'Transportation',
                data: @json($transportation_history),
                borderColor: '#007bff',
                fill: false
            },
            {
                label: 'Energy',
                data: @json($energy_history),
                borderColor: '#28a745',
                fill: false
            },
            {
                label: 'Diet',
                data: @json($diet_history),
                borderColor: '#dc3545',
                fill: false
            }]
        };

        // Line Chart Configuration
        const lineChartConfig = {
            type: 'line',
            data: lineChartData,
            options: {
                scales: {
                    x: { title: { display: true, text: 'Date' } },
                    y: { title: { display: true, text: 'kg CO₂' } }
                }
            }
        };

        // Render Line Chart
        const footprintLineChart = new Chart(document.getElementById('footprintLineChart'), lineChartConfig);
    </script>
</div>
@endsection

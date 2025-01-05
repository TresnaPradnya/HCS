@extends('layouts.index')

@section('title')
    <strong>Historical Trends</strong>
@endsection

@section('content')
    <div class="container mt-5">

        <!-- Date Range Picker Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="{{ route('historical-trends.index') }}" method="GET" class="form-inline">
                    <label for="start_date" class="mr-2">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control mr-2"
                        value="{{ $startDate }}">
                    <label for="end_date" class="mr-2">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control mr-2"
                        value="{{ $endDate }}">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        <!-- Summary of Footprints -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Transportation</h5>
                        <h3 class="text-primary">{{ $transportationFootprint }} kg CO₂</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Energy</h5>
                        <h3 class="text-success">{{ $energyFootprint }} kg CO₂</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Diet</h5>
                        <h3 class="text-danger">{{ $dietFootprint }} kg CO₂</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Footprint -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Carbon Footprint</h5>
                        <h3 class="text-info">{{ $totalFootprint }} kg CO₂</h3>
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
                        <canvas id="footprintDonutChart"></canvas> <!-- Donut Chart -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Carbon Footprint Trends</h5>
                        <canvas id="footprintAreaChart"></canvas> <!-- Area Chart -->
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Data for Donut Chart
            const donutChartData = {
                labels: ['Transportation', 'Energy', 'Diet'],
                datasets: [{
                    data: [
                        {{ $transportationFootprint }},
                        {{ $energyFootprint }},
                        {{ $dietFootprint }}
                    ],
                    backgroundColor: ['#007bff', '#28a745', '#dc3545']
                }]
            };

            // Donut Chart Configuration
            const donutChartConfig = {
                type: 'doughnut',
                data: donutChartData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    cutout: '50%' // Membuat Donut
                }
            };

            // Render Donut Chart
            const footprintDonutChart = new Chart(document.getElementById('footprintDonutChart'), donutChartConfig);

            // Data for Area Chart
            const areaChartData = {
                labels: @json($dates), // Tanggal
                datasets: [{
                        label: 'Transportation',
                        data: @json($transportationHistory),
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        fill: true
                    },
                    {
                        label: 'Energy',
                        data: @json($energyHistory),
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        fill: true
                    },
                    {
                        label: 'Diet',
                        data: @json($dietHistory),
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.2)',
                        fill: true
                    }
                ]
            };

            // Area Chart Configuration
            const areaChartConfig = {
                type: 'line', // Menggunakan grafik garis dengan opsi `fill: true` untuk membuat area
                data: areaChartData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Date',
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'kg CO₂',
                            },
                            beginAtZero: true
                        }
                    }
                }
            };

            // Render Area Chart
            const footprintAreaChart = new Chart(document.getElementById('footprintAreaChart'), areaChartConfig);
        </script>
    </div>
@endsection

@extends('layouts.index')
@section('title')
    <strong>Recommendation</strong>
@endsection

@section('content')
    @php
        // Mendapatkan nilai terbesar
        $values = [
            'commuting' => $data->total_commuting,
            'dietary' => $data->total_dietary,
            'energy' => $data->total_energy,
        ];

        if ($data->total_commuting == 0 && $data->total_dietary == 0 && $data->total_energy == 0) {
            $recommendation = 'No recommendation available. Please make sure there is activity data for the selected date range.';
        } else {
            $maxValue = max($values);
            $recommendation = '';
    
            if ($maxValue == $data->total_commuting) {
                $recommendation =
                    'Commuting is your highest activity. Consider focusing on improving your transportation habits for better efficiency and health.';
            } elseif ($maxValue == $data->total_dietary) {
                $recommendation =
                    'Dietary habits are your strongest area. Keep up with your nutrition for sustained energy and well-being.';
            } elseif ($maxValue == $data->total_energy) {
                $recommendation =
                    'Energy levels are high. You are maintaining a good balance of energy intake, keep it up!';
            }
        }
    @endphp
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bicycle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Commuting</span>
                        <span class="info-box-number">
                            {{ $data->total_commuting }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-carrot"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Dietary</span>
                        <span class="info-box-number">{{ $data->total_dietary }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bolt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Energy</span>
                        <span class="info-box-number">{{ $data->total_energy }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-bar"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total</span>
                        <span class="info-box-number">{{ $data->total_activity_value }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Recommendation</h3>
                    </div>
                    <div class="card-body text-center">
                        <h3>{{ $recommendation }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

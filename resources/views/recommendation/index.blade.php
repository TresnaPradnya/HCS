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
    
            if ($maxValue == $data->total_commuting) 
            {
                $recommendation =
                    'Based on the daily activities you input into the system,<span style="color: red;">commuting is identified as the major contributor to your carbon footprint.</span> Please consider enhancing your transportation habits for greater efficiency and health benefits, such as increasing your walking or using public transportation more often.';
            } 
            elseif ($maxValue == $data->total_dietary) 
            {
                $recommendation =
                    '<span style="color: red;">Dietary habits are your strongest area.</span> With choices ranging from vegan to heavy meat consumption, maintaining your nutritional focus is crucial for sustained energy and well-being. If you are looking to further reduce your carbon footprint, consider exploring more plant-based options like vegan or vegetarian diets.';
            } 
            elseif ($maxValue == $data->total_energy) 
            {
                $recommendation =
                '<span style="color: red;">Your energy consumption is higher than average.</span> To improve efficiency and reduce environmental impact, consider implementing energy-saving measures such as using LED lighting, optimizing heating and cooling systems, and unplugging devices when not in use.';
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
                        <h3>{!! $recommendation !!}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

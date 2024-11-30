<?php

namespace Database\Seeders;

use App\Models\EnergySourceModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnergySources extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EnergySourceModel::create([
            'name' => 'Solar',
            'value' => 0.02,
        ]); 
        EnergySourceModel::create([
            'name' => 'Wind',
            'value' => 0.01,
        ]);
        EnergySourceModel::create([
            'name' => 'Hydro',
            'value' => 0.02,
        ]);
        EnergySourceModel::create([
            'name' => 'Biomass',
            'value' => 0.10,
        ]);
        EnergySourceModel::create([
            'name' => 'Natural Gas',
            'value' => 0.25,
        ]);
        EnergySourceModel::create([
            'name' => 'Coal',
            'value' => 0.85,
        ]);
    }
}

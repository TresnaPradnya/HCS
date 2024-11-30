<?php

namespace Database\Seeders;

use App\Models\CommutingMethodsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommutingMethods extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        CommutingMethodsModel::create([
            'name' => 'Walking',
            'value' => 0.00,
        ]);
        CommutingMethodsModel::create([
            'name' => 'Cycling',
            'value' => 0.01,
        ]);
        CommutingMethodsModel::create([
            'name' => 'Public Transport(Bus)',
            'value' => 0.05,
        ]);
        CommutingMethodsModel::create([
            'name' => 'Public Transport(Train)',
            'value' => 0.03,
        ]);
        CommutingMethodsModel::create([
            'name' => 'Car(Gasoline)',  
            'value' => 0.25,
        ]);
        CommutingMethodsModel::create([
            'name' => 'Car(Electric)',
            'value' => 0.10,
        ]);
        CommutingMethodsModel::create([
            'name' => 'Motorcycle(Gasoline)',
            'value' => 0.15,
        ]);
    }
}

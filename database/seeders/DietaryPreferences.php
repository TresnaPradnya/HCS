<?php

namespace Database\Seeders;

use App\Models\DietaryPreferencesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DietaryPreferences extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DietaryPreferencesModel::create([
            'name' => 'Vegan',
            'value' => 2.0,
        ]);
        DietaryPreferencesModel::create([
            'name' => 'Vegetarian',
            'value' => 3.0,
        ]);
        DietaryPreferencesModel::create([
            'name' => 'Pescatarian',
            'value' => 4.0,
        ]); 
        DietaryPreferencesModel::create([
            'name' => 'Omnivore',
            'value' => 7.0,
        ]);
        DietaryPreferencesModel::create([
            'name' => 'Heavy Meat Consumer',
            'value' => 10.0,
        ]);
    }
}

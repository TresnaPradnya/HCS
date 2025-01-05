<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityLogSeeder extends Seeder
{
    public function run()
    {
        DB::table('activity_logs')->insert([
            [
                'user_id' => 1,
                'date' => '2025-01-01',
                'commuting_method_value' => 5.0,
                'energy_source_value' => 7.0,
                'dietary_preference_value' => 3.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'date' => '2025-01-02',
                'commuting_method_value' => 4.0,
                'energy_source_value' => 5.0,
                'dietary_preference_value' => 3.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalTracking extends Model
{
    use HasFactory;

    protected $table = 'historical_trackings';
    protected $fillable = [
        'user_id',
        'date',
        'commuting_method_value',
        'energy_source_value',
        'dietary_preference_value',
        'carbon_footprint',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

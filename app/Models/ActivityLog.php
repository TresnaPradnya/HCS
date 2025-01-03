<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $table = 'activity_logs';

    protected $fillable = [
        'date',
        'user_id',
        'commuting_method_id',
        'dietary_preference_id',
        'energy_source_id',
        'commuting_method_value',
        'dietary_preference_value',
        'energy_source_value',
    ];

    protected $casts = [
        'commuting_method_value' => 'double',
        'dietary_preference_value' => 'double',
        'energy_source_value' => 'double',
    ];

    public function commutingMethod()
    {
        return $this->belongsTo(CommutingMethodsModel::class, 'commuting_method_id');
    }
    public function dietaryPreference()
    {
        return $this->belongsTo(DietaryPreferencesModel::class, 'dietary_preference_id');
    }
    public function energySource()
    {
        return $this->belongsTo(EnergySourceModel::class, 'energy_source_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

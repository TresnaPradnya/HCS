<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetailModel extends Model
{
    use HasFactory;
    protected $table = 'user_details';
    protected $fillable = ['user_id', 'commuting_method_id', 'dietary_preference_id', 'energy_source_id'];

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

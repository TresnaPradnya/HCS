<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietaryPreferencesModel extends Model
{
    use HasFactory;
    protected $table = 'dietary_preferences';
    protected $fillable = ['name', 'value'];
}

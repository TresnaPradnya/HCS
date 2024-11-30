<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergySourceModel extends Model
{
    use HasFactory;
    protected $table = 'energy_sources';
    protected $fillable = ['name', 'value'];
}

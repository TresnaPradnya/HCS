<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommutingMethodsModel extends Model
{
    use HasFactory;
    protected $table = 'commuting_methods';
    protected $fillable = ['name', 'value'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'content',
        'pie_chart_image',
        'line_chart_image',
        'transportation_footprint',
        'energy_footprint',
        'diet_footprint',
        'total_footprint',
        'visibility'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function likes()
    {
        return $this->interactions()->where('type', 'like');
    }

    public function comments()
    {
        return $this->interactions()->where('type', 'comment');
    }
}

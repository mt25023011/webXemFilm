<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'name',
        'slug',
        'thumbnail',
        'season_number',
        'release_date',
        'description',
        'status'
    ];

    protected $casts = [
        'release_date' => 'date',
        'season_number' => 'integer',
        'status' => 'boolean'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}

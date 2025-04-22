<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'season_id',
        'name',
        'slug',
        'link',
        'thumbnail',
        'episode_number',
        'duration',
        'views',
        'status'
    ];

    protected $casts = [
        'episode_number' => 'integer',
        'duration' => 'integer',
        'views' => 'integer',
        'status' => 'boolean'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function watchHistory()
    {
        return $this->hasMany(WatchHistory::class);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}

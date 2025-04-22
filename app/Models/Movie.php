<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'trailer',
        'type',
        'release_date',
        'duration',
        'resolution',
        'language',
        'quality',
        'rating',
        'imdb_rating',
        'views',
        'category_id',
        'country_id',
        'genre_id',
        'status'
    ];

    protected $casts = [
        'release_date' => 'date',
        'rating' => 'decimal:1',
        'imdb_rating' => 'decimal:1',
        'views' => 'integer',
        'status' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function watchHistory()
    {
        return $this->hasMany(WatchHistory::class);
    }

    public function isSeries()
    {
        return $this->type === 'series';
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}

<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;

class HomeService
{
    public function getHomeData()
    {
        $categories = Category::all();
        $countries = Country::all();
        $genres = Genre::all();
        
        return [
            'categories' => $categories,
            'countries' => $countries,
            'genres' => $genres
        ];
    }

    public function getMoviesByCountry($countryId)
    {
        return Movie::where('country_id', $countryId)->get();
    }
} 
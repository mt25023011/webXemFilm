<?php

namespace App\Http\Controllers\homeController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Services\HomeService;

class IndexController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $data = $this->homeService->getHomeData();
        return view('pages.home', $data);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categories = Category::all();
        $movies = Movie::where('category_id', $category->id)->get();
        $countries = Country::all();
        $genres = Genre::all();
        return view('pages.category', compact('category', 'categories', 'movies', 'countries', 'genres'));
    }

    public function genre($slug)
    {
        $genre = Genre::where('slug', $slug)->first();
        $categories = Category::all();
        $movies = Movie::where('genre_id', $genre->id)->get();
        $countries = Country::all();
        $genres = Genre::all();
        return view('pages.genre', compact('genre', 'categories', 'movies', 'countries', 'genres'));
    }

    public function country($slug)
    {
        $country = Country::where('slug', $slug)->first();
        $movies = $this->homeService->getMoviesByCountry($country->id);
        $data = $this->homeService->getHomeData();
        
        return view('pages.country', array_merge($data, [
            'country' => $country,
            'movies' => $movies
        ]));
    }

    public function movie()
    {
        $movies = Movie::all();
        $categories = Category::all();
        $countries = Country::all();
        $genres = Genre::all();
        return view('pages.movie', compact('movies', 'categories', 'countries', 'genres'));
    }

    public function watch()
    {
        return view('pages.watch');
    }

    public function episode()
    {
        $episodes = Episode::all();
        $countries = Country::all();
        $genres = Genre::all();
        return view('pages.episode', compact('episodes', 'countries', 'genres'));
    }
}
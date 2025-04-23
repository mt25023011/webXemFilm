<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::with(['category', 'country', 'genre'])->get();
        return view('admincp.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $countries = Country::all();
        $genres = Genre::all();
        return view('admincp.movies.create', compact('categories', 'countries', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trailer' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
            'type' => 'required|in:single,series',
            'release_date' => 'required|date',
            'duration' => 'required|string',
            'resolution' => 'required|string',
            'language' => 'required|string',
            'quality' => 'required|string',
            'rating' => 'required|numeric|between:0,10',
            'imdb_rating' => 'required|numeric|between:0,10',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'genre_id' => 'required|exists:genres,id',
            'status' => 'required|boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/movies/images'), $imageName);
        }

        // Handle trailer upload
        $trailerName = null;
        if ($request->hasFile('trailer')) {
            $trailer = $request->file('trailer');
            $trailerName = time() . '_' . $trailer->getClientOriginalName();
            $trailer->move(public_path('uploads/movies/trailers'), $trailerName);
        }

        // Create slug from title
        $slug = \Str::slug($request->title);

        // Create movie
        $movie = Movie::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imageName ?? null,
            'trailer' => $trailerName,
            'type' => $request->type,
            'release_date' => $request->release_date,
            'duration' => $request->duration,
            'resolution' => $request->resolution,
            'language' => $request->language,
            'quality' => $request->quality,
            'rating' => $request->rating,
            'imdb_rating' => $request->imdb_rating,
            'views' => 0,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'genre_id' => $request->genre_id,
            'status' => $request->status
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all();
        $countries = Country::all();
        $genres = Genre::all();
        return view('admincp.movies.edit', compact('movie', 'categories', 'countries', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'trailer' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
            'type' => 'required|in:single,series',
            'release_date' => 'required|date',
            'duration' => 'required|string',
            'resolution' => 'required|string',
            'language' => 'required|string',
            'quality' => 'required|string',
            'rating' => 'required|numeric|between:0,10',
            'imdb_rating' => 'required|numeric|between:0,10',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'genre_id' => 'required|exists:genres,id',
            'status' => 'required|boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($movie->image && file_exists(public_path('uploads/movies/images/' . $movie->image))) {
                unlink(public_path('uploads/movies/images/' . $movie->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/movies/images'), $imageName);
            $movie->image = $imageName;
        }

        // Handle trailer upload
        if ($request->hasFile('trailer')) {
            // Delete old trailer
            if ($movie->trailer && file_exists(public_path('uploads/movies/trailers/' . $movie->trailer))) {
                unlink(public_path('uploads/movies/trailers/' . $movie->trailer));
            }

            $trailer = $request->file('trailer');
            $trailerName = time() . '_' . $trailer->getClientOriginalName();
            $trailer->move(public_path('uploads/movies/trailers'), $trailerName);
            $movie->trailer = $trailerName;
        }

        // Update other fields
        $movie->title = $request->title;
        $movie->slug = \Str::slug($request->title);
        $movie->description = $request->description;
        $movie->type = $request->type;
        $movie->release_date = $request->release_date;
        $movie->duration = $request->duration;
        $movie->resolution = $request->resolution;
        $movie->language = $request->language;
        $movie->quality = $request->quality;
        $movie->rating = $request->rating;
        $movie->imdb_rating = $request->imdb_rating;
        $movie->category_id = $request->category_id;
        $movie->country_id = $request->country_id;
        $movie->genre_id = $request->genre_id;
        $movie->status = $request->status;

        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Delete image
        if ($movie->image && file_exists(public_path('uploads/movies/images/' . $movie->image))) {
            unlink(public_path('uploads/movies/images/' . $movie->image));
        }

        // Delete trailer
        if ($movie->trailer && file_exists(public_path('uploads/movies/trailers/' . $movie->trailer))) {
            unlink(public_path('uploads/movies/trailers/' . $movie->trailer));
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}

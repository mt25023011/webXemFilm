<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        return view('admincp.genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:genres,title',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Tên thể loại không được để trống',
            'title.string' => 'Tên thể loại phải là chuỗi ký tự',
            'title.max' => 'Tên thể loại không được vượt quá 255 ký tự',
            'title.unique' => 'Tên thể loại đã tồn tại',
            'description.string' => 'Mô tả phải là chuỗi ký tự',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'status.boolean' => 'Trạng thái phải là true hoặc false',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the genre
        Genre::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'status' => $request->status
        ]);

        return redirect()->route('genres.index')->with('success', 'Thể loại đã được thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return redirect()->route('genres.index')->with('error', 'Không tìm thấy thể loại với ID: ' . $id);
        }

        return view('admincp.genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return redirect()->route('genres.index')->with('error', 'Không tìm thấy thể loại với ID: ' . $id);
        }

        return view('admincp.genres.edit', compact('genre'));
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
        // Find the genre
        $genre = Genre::find($id);

        if (!$genre) {
            return redirect()->route('genres.index')->with('error', 'Không tìm thấy thể loại với ID: ' . $id);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('genres', 'title')->ignore($id),
            ],
            'description' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Tên thể loại không được để trống',
            'title.string' => 'Tên thể loại phải là chuỗi ký tự',
            'title.max' => 'Tên thể loại không được vượt quá 255 ký tự',
            'title.unique' => 'Tên thể loại đã tồn tại',
            'description.string' => 'Mô tả phải là chuỗi ký tự',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'status.boolean' => 'Trạng thái phải là true hoặc false',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the genre
        $genre->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'status' => $request->status
        ]);

        return redirect()->route('genres.index')->with('success', 'Thể loại đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $genre = Genre::findOrFail($id);
            $genre->delete();
            return redirect()->route('genres.index')->with('success', 'Thể loại đã được xóa thành công');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('genres.index')->with('error', 'Không tìm thấy thể loại với ID: ' . $id);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admincp.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.categories.create');
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
            'title' => 'required|string|max:255|unique:categories,title',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Tên danh mục không được để trống',
            'title.string' => 'Tên danh mục phải là chuỗi ký tự',
            'title.max' => 'Tên danh mục không được vượt quá 255 ký tự',
            'title.unique' => 'Tên danh mục đã tồn tại',
            'description.string' => 'Mô tả phải là chuỗi ký tự',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'status.boolean' => 'Trạng thái phải là true hoặc false',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Lỗi: ' . $validator->errors()->first())
            ->withInput()
            ->withErrors($validator);
        }

        // Create the category
        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'status' => $request->status
        ]);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được thêm thành công');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Không tìm thấy danh mục với ID: ' . $id);
        }

        return view('admincp.categories.update', compact('category'));
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
        // Find the category
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Không tìm thấy danh mục với ID: ' . $id);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'title')->ignore($id),
            ],
            'description' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Tên danh mục không được để trống',
            'title.string' => 'Tên danh mục phải là chuỗi ký tự',
            'title.max' => 'Tên danh mục không được vượt quá 255 ký tự',
            'title.unique' => 'Tên danh mục đã tồn tại',
            'description.string' => 'Mô tả phải là chuỗi ký tự',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'status.boolean' => 'Trạng thái phải là true hoặc false',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Lỗi: ' . $validator->errors()->first())
            ->withInput()
            ->withErrors($validator);
        }

        // Update the category
        $category->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'status' => $request->status
        ]);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công');
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
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('categories.index')->with('error', 'Không tìm thấy danh mục với ID: ' . $id);
        }
    }
}

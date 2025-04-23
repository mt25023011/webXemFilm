<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('admincp.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.countries.create');
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
            'title' => 'required|string|max:255|unique:countries,title',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Tên quốc gia không được để trống',
            'title.string' => 'Tên quốc gia phải là chuỗi ký tự',
            'title.max' => 'Tên quốc gia không được vượt quá 255 ký tự',
            'title.unique' => 'Tên quốc gia đã tồn tại',
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

        // Create the country
        Country::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'status' => $request->status
        ]);

        return redirect()->route('countries.index')->with('success', 'Quốc gia đã được thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);

        if (!$country) {
            return redirect()->route('countries.index')->with('error', 'Không tìm thấy quốc gia với ID: ' . $id);
        }

        return view('admincp.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);

        if (!$country) {
            return redirect()->route('countries.index')->with('error', 'Không tìm thấy quốc gia với ID: ' . $id);
        }

        return view('admincp.countries.edit', compact('country'));
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
        // Find the country
        $country = Country::find($id);

        if (!$country) {
            return redirect()->route('countries.index')->with('error', 'Không tìm thấy quốc gia với ID: ' . $id);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('countries', 'title')->ignore($id),
            ],
            'description' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
        ], [
            'title.required' => 'Tên quốc gia không được để trống',
            'title.string' => 'Tên quốc gia phải là chuỗi ký tự',
            'title.max' => 'Tên quốc gia không được vượt quá 255 ký tự',
            'title.unique' => 'Tên quốc gia đã tồn tại',
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

        // Update the country
        $country->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'status' => $request->status
        ]);

        return redirect()->route('countries.index')->with('success', 'Quốc gia đã được cập nhật thành công');
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
            $country = Country::findOrFail($id);
            $country->delete();
            return redirect()->route('countries.index')->with('success', 'Quốc gia đã được xóa thành công');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('countries.index')->with('error', 'Không tìm thấy quốc gia với ID: ' . $id);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $datas = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.category', compact('datas'));
    }
    public function create()
    {
        return view('admin.pages.add-category');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        // Create a new category
        $category = Category::create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'icon' => $request->input('icon'),
        ]);

        // Redirect to a page with a success message
        return redirect()->route('categories.index')->with('success', 'Danh mục đã được thêm thành công.');
    }

    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        // Find the category by ID
        $category = Category::find($request->id);

        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Danh mục không tồn tại.');
        }

        // Update the category information
        $category->name = $request->input('name');
        $category->desc = $request->input('desc');
        $category->icon = $request->input('icon');

        // Save the updated category
        $category->save();

        // Optionally, you can return a response or redirect somewhere
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }


    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        Category::destroy($request->id);

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('categories', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {

        $validatedInput = $this->validate($request, [
            'category' => 'required|max:255|unique:mysql2.categories',
        ]);

        Category::create($validatedInput);

        return redirect()->route('categories')->with('status','Category added successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories')->with('status','Category deleted successfully.');
    }
}

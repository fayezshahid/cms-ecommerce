<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::get();
        return view('sizes', [
            'sizes' => $sizes,
        ]);
    }

    public function store(Request $request)
    {

        $validatedInput = $this->validate($request, [
            'size' => 'required|max:255|unique:mysql2.sizes',
        ]);

        Size::create($validatedInput);

        return redirect()->route('sizes')->with('status','Size added successfully.');
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('sizes')->with('status','Size deleted successfully.');
    }
}

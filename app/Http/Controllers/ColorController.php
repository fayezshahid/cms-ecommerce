<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::get();
        return view('colors', [
            'colors' => $colors,
        ]);
    }

    public function store(Request $request)
    {

        $validatedInput = $this->validate($request, [
            'color' => 'required|max:255|unique:mysql2.colors',
        ]);

        Color::create($validatedInput);

        return redirect()->route('colors')->with('status','Color added successfully.');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('colors')->with('status','Color deleted successfully.');
    }
}

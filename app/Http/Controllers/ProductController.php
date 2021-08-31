<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Color_Product;
use App\Models\Image;
use App\Models\Product;
use App\Models\Product_Size;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stringable;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('product',[
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::get();
        $sizes = Size::get();
        $colors = Color::get();
        return view('addproduct', [
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required',
            'featured_image' => 'required',
            'size' => 'required',
            'color' => 'required',
        ]);

        if(count($request->color) != count($request->image))
        {
            return redirect()->back()->with('error', 'The number of images must be equal to the number of colors!')->withInput();
        }

        $image = Storage::disk('productImage')->putFile('', $request->featured_image);
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'featured_image' => $image,
        ]);


        for($i=0; $i<count($request->color); $i++)
        {
            $img = Storage::disk('productImage')->putFile('', $request->image[$i]);
            Color_Product::create([
                'product_id' => $product->id,
                'color_id' => $request->color[$i],
                'image' => $img,
            ]);
        }

        // $colorId = $request->color;
        // $product->colors()->sync($colorId => ['image' => ]);

        $sizeId = $request->size;
        $product->sizes()->sync($sizeId);

        return redirect()->route('products')->with('status','Product added successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::get();
        $sizes = Size::get();
        $colors = Color::get();
        return view('editproduct', [
            'product' => $product,
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validatedInput = $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'featured_image' => 'required',
        ]);


        $this->validate($request, [
            'image' => 'required',
            'size' => 'required',
            'color' => 'required',
        ]);

        if(count($request->color) != count($request->image))
        {
            return redirect()->back()->with('error', 'The number of images must be equal to the number of colors!')->withInput();
        }

        if($request->hasFile('featured_image'))
        {
            $image = Storage::disk('productImage')->putFile('', $request->featured_image);
            $validatedInput['featured_image'] = $image;
        }

        $product->update($validatedInput);

        Color_Product::where('product_id', '=', $product->id)->delete();

        for($i=0; $i<count($request->color); $i++)
        {
            $img = Storage::disk('productImage')->putFile('', $request->image[$i]);
            Color_Product::create([
                'product_id' => $product->id,
                'color_id' => $request->color[$i],
                'image' => $img,
            ]);
        }

        $sizeId = $request->size;
        $product->sizes()->sync($sizeId);

        return redirect()->route('products')->with('status','Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $product->orders()->delete();
        $product->images()->delete();
        return redirect()->route('products')->with('status','Product deleted successfully.');
    }


}

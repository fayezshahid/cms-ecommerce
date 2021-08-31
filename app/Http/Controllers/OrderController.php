<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // $products = Product::join('orders', 'products.id', '=', 'orders.product_id')->get();
        $orders = Order::latest()->get();
        return view('orders',[
            // 'products' => $products,
            'orders' => $orders,
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('products')->with('status','Order completed successfully.');
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class OrderProductController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('Layouts.Order.create', compact('products'));
    }

    public function store(Request $request)
    {
        $order = Order::create(['user_id' => Auth::id()]);
        $products = $request->input('products', []);
        $quantities = $request->input('quantities', []);
        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $findProduct = Product::find($products[$product]);
                try {
                    if ($findProduct->quantity > $quantities[$product]) {
                        OrderProduct::create([
                            'order_id' => $order->id,
                            'product_id' => $products[$product],
                            'quantity' => $quantities[$product],
                            'price' => ($findProduct->price * $quantities[$product]),
                        ]);
                        $findProduct->update(['quantity' => ($findProduct['quantity'] - $quantities[$product])]);

                    }
                } catch (Exception $e) {
                    var_dump('Exception Message: ' . $e->getMessage());
                }
            }
        }
        return back();
    }
}

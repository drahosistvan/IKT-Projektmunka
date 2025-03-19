<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Squire\Models\Country;

class CartController extends Controller
{
    public function index()
    {
        return Inertia::render('Cart', []);
    }

    public function checkout()
    {
        return Inertia::render('Checkout', [
            'countries' => Country::all(['code_2', 'name']),
            'user' => auth()->user(),
        ]);
    }

    public function orderSubmitted()
    {
        return Inertia::render('OrderSubmitted', []);
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'billing_name' => 'required|string|max:255',
            'billing_country' => 'required|string|max:255',
            'billing_street' => 'required|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_zip' => 'required|string|max:255',
            'shipping_name' => 'required|string|max:255',
            'shipping_country' => 'required|string|max:255',
            'shipping_street' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_zip' => 'required|string|max:255',
        ]);

        $order = new Order();
        $order->fill($request->all());
        $order->total_price = $request->total;
        $order->shipping_price = $request->shipping_cost;
        $order->save();

        $orderItems = [];
        foreach ($request->products as $product) {
            $orderItems[] = [
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'qty' => $product['quantity'],
                'unit_price' => $product['price'],
            ];
        }

        $order->items()->createMany($orderItems);

        return to_route('order');
    }
}

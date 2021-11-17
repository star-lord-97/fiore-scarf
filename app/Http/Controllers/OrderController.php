<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ProductSize;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('items', 'user')->latest()->get();
    }

    public function store(Request $request)
    {
        $promoCode = PromoCode::where('code', $request->promoCode)->first();
        if ($promoCode) {
            $promoCode->update([
                'used_times' => ++$promoCode->used_times,
            ]);
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'subtotal' => $request->subTotal,
            'promocode_used' => $request->promoCode,
            'total' => $request->total,
            'notes' => $request->notes
        ]);

        foreach ($request->products as $product) {
            $size = ProductSize::where('product_id', $product['id'])->where('size', $product['size'])->first();
            $size->update([
                'units' => $size->units - $product['quantity']
            ]);

            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'size' => $product['size'],
            ]);
        }
    }

    public function update(Order $order)
    {
        $order->update([
            'is_shipped' => true,
            'shipping_date' => now()
        ]);

        return Order::with('items', 'user')->latest()->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function show(Request $request)
    {
        return Cart::where('user_id', $request->user()->id)->with('product')->latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate(
            ['size' => 'required',],
            ['size.required' => 'You have to select a size!',]
        );

        $cart = Cart::firstOrCreate(
            ['product_id' => $request->product_id, 'user_id' => $request->user()->id],
            [
                'quantity' => $request->quantity,
                'size' => $request->size
            ]
        );

        if (!$cart->wasRecentlyCreated) {
            throw ValidationException::withMessages(['existsInCart' => ["This item is already in your Cart!!"]]);
        }
    }

    public function update(Cart $cart, Request $request)
    {
        $cart->update([
            'quantity' => $request->quantity,
            'size' => $request->size
        ]);

        return Cart::where('user_id', $request->user()->id)->with('product')->get();
    }

    public function destroy(Cart $cart, Request $request)
    {
        $cart->delete();
        return Cart::where('user_id', $request->user()->id)->with('product')->get();
    }
}

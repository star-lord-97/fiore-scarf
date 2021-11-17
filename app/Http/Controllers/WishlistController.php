<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WishlistController extends Controller
{
    public function show(Request $request)
    {
        $wishes = Wishlist::where('user_id', $request->user()->id)->with('product')->latest()->get();

        $wishes->map(function ($wish) {
            $wish['product']['existsInUserCart'] = $wish['product']->existsInUserCart();
            $wish['product']['existsInUserWishlist'] = true;
        });

        return $wishes;
    }

    public function store(Request $request)
    {
        $wishlist = Wishlist::firstOrCreate(
            [
                'product_id' => $request->product_id,
                'user_id' => $request->user()->id
            ],
        );

        if (!$wishlist->wasRecentlyCreated) {
            throw ValidationException::withMessages(['existsInWishlist' => ["This item is already in your Wishlist!!"]]);
        }
    }

    public function destroy(Wishlist $wishlist, Request $request)
    {
        $wishlist->delete();
        return Wishlist::where('user_id', $request->user()->id)->with('product')->get();
    }
}

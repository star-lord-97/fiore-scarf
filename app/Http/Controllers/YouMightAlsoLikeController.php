<?php

namespace App\Http\Controllers;

use App\Models\Product;

class YouMightAlsoLikeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Product $product)
    {
        $products = Product::with('mainImage', 'sizes')->where('id', '!=', $product->id)->inRandomOrder()->take(3)->get();

        if (auth('api')->user()) {
            $products->map(function ($prod) {
                $prod['existsInUserCart'] = $prod->existsInUserCart();
                $prod['existsInUserWishlist'] = $prod->existsInUserWishlist();
                return $prod;
            });
        }

        return $products;
    }
}

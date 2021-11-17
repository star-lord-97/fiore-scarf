<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('mainImage', 'sizes')->latest()->take(3)->get();

        if (auth('api')->user()) {
            $products->map(function ($prod) {
                $prod['existsInUserCart'] = $prod->existsInUserCart();
                $prod['existsInUserWishlist'] = $prod->existsInUserWishlist();
                return $prod;
            });
        }

        return $products;
    }

    public function update(Request $request)
    {
        File::deleteDirectory(public_path('vid'));
        $file = $request->file('hero');
        $filename = 'hero.' . $file->clientExtension();
        $path = public_path() . '/vid/';
        $file->move($path, $filename);
        return $file->clientExtension();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        return array(
            'categories' => Product::pluck('category')->unique(),
            'show_on_sale_category' => boolval(Product::where('sale', true)->count())
        );
    }

    public function show($category)
    {
        if ($category == "New In Store") {
            $products = Product::latest()->with('mainImage', 'sizes')->paginate(9);
        } else if ($category == 'On Sale') {
            $products = Product::where('sale', true)->latest()->with('mainImage', 'sizes')->paginate(9);
        } else {
            $products = Product::where('category', $category)->latest()->with('mainImage', 'sizes')->paginate(9);
        }

        return $products;
    }

    public function sort($category, $method)
    {
        if ($category == "New In Store") {
            $products = Product::with('mainImage', 'sizes')->orderBy('price', $method)->paginate(9);
        } else if ($category == 'On Sale') {
            $products = Product::where('sale', true)->with('mainImage', 'sizes')->orderBy('price', $method)->paginate(9);
        } else {
            $products = Product::where('category', $category)->with('mainImage', 'sizes')->orderBy('price', $method)->paginate(9);
        }

        return $products;
    }
}

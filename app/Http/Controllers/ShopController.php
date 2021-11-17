<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index()
    {
        return Product::select('id', 'code', 'name', 'details', 'price', 'category', 'sale')->with('images', 'sizes')->latest()->get();
    }

    public function show(Product $product)
    {
        return $product->load('images', 'mainImage', 'sizes');
    }

    public function store(Request $request)
    {
        $validatedAttributes = $request->validate([
            'name' => 'required|string',
            'code' => 'required|unique:products|string',
            'details' => 'required|string',
            'price' => 'required|numeric',
            'sale' => 'required',
            'category' => 'required',
            // 'sizes' => 'required',
            'images' => 'required',
            'images.*' => 'image'
        ], [
            'image' => 'Uploaded files can only be images.'
        ]);

        $createdProduct = Product::create(Arr::only(
            $validatedAttributes,
            ['name', 'code', 'details', 'sale', 'price', 'category']
        ));

        foreach ($request->sizes as $index => $size) {
            if ($size !== 'null') {
                ProductSize::create([
                    'product_id' => $createdProduct->id,
                    'size' => $size,
                    'units' => $request->units[$index]
                ]);
            }
        }

        foreach ($request->images as $index => $image) {
            $img = Image::make($image)->fit(400, 500)->save('product_images/' . Str::random(40) . '.jpg');
            ProductImage::create([
                'product_id' => $createdProduct->id,
                'image_path' => '/' . $img->basePath(),
                'main' => $index == 0 ? 1 : 0
            ]);
        }

        // return Product::select('id', 'code', 'name', 'details', 'price', 'sale')->with('images', 'sizes')->latest()->get();
        return Product::select('id', 'code', 'name', 'category', 'details', 'price', 'sale')->with('images')->latest()->get();
    }

    /**
     * update
     *
     * @param  mixed $product
     * @param  mixed $request
     * @return void
     */
    public function update(Product $product, Request $request)
    {
        if ($request->attribute === 'price') {
            $product->update([
                'price' => $request->price
            ]);
        }

        if ($request->attribute === 'sale') {
            $product->update([
                'sale' => !$product['sale']
            ]);
        }

        if ($request->attribute === 'units') {
            $productSize = ProductSize::where('product_id', $product->id)->first();

            $productSize->update([
                'units' => $request['units']
            ]);
        }

        return Product::select('id', 'code', 'name', 'details', 'price', 'category', 'sale')->with('images', 'sizes')->latest()->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return Product::select('id', 'code', 'name', 'details', 'price', 'category', 'sale')->with('images', 'sizes')->latest()->get();
    }
}

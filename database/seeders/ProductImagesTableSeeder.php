<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductImage::create([
            'product_id' => 1,
            'image_path' => '/product_images/7txHjMOW3oWBXwYR3p1vkZLNY.jpg',
            'main' => true,
        ]);
        ProductImage::create([
            'product_id' => 1,
            'image_path' => '/product_images/7txHjMOW3oWBXwYR3p1vkZLNY.jpg',
            'main' => false,
        ]);
        ProductImage::create([
            'product_id' => 1,
            'image_path' => '/product_images/7txHjMOW3oWBXwYR3p1vkZLNY.jpg',
            'main' => false,
        ]);

        ProductImage::create([
            'product_id' => 2,
            'image_path' => '/product_images/5qleOmjLfcZluuUvefNq7mtF88M.jpg',
            'main' => true,
        ]);
        ProductImage::create([
            'product_id' => 2,
            'image_path' => '/product_images/5qleOmjLfcZluuUvefNq7mtF88M.jpg',
            'main' => false,
        ]);
        ProductImage::create([
            'product_id' => 2,
            'image_path' => '/product_images/5qleOmjLfcZluuUvefNq7mtF88M.jpg',
            'main' => false,
        ]);

        ProductImage::create([
            'product_id' => 3,
            'image_path' => '/product_images/Eo8HwE8qac53HbG2XH1peLUk.jpg',
            'main' => true,
        ]);
        ProductImage::create([
            'product_id' => 3,
            'image_path' => '/product_images/Eo8HwE8qac53HbG2XH1peLUk.jpg',
            'main' => false,
        ]);
        ProductImage::create([
            'product_id' => 3,
            'image_path' => '/product_images/Eo8HwE8qac53HbG2XH1peLUk.jpg',
            'main' => false,
        ]);

        ProductImage::create([
            'product_id' => 4,
            'image_path' => '/product_images/Eo8HwE8qac53HbG2XH1peLUk.jpg',
            'main' => true,
        ]);
        ProductImage::create([
            'product_id' => 4,
            'image_path' => '/product_images/Eo8HwE8qac53HbG2XH1peLUk.jpg',
            'main' => false,
        ]);
        ProductImage::create([
            'product_id' => 4,
            'image_path' => '/product_images/Eo8HwE8qac53HbG2XH1peLUk.jpg',
            'main' => false,
        ]);

        ProductImage::create([
            'product_id' => 5,
            'image_path' => '/product_images/m-t.jpg',
            'main' => true,
        ]);
        ProductImage::create([
            'product_id' => 5,
            'image_path' => '/product_images/m-t.jpg',
            'main' => false,
        ]);
        ProductImage::create([
            'product_id' => 5,
            'image_path' => '/product_images/m-t.jpg',
            'main' => false,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductSize;
use Illuminate\Database\Seeder;

class ProductSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductSize::create([
            'product_id' => 1,
            'size' => 'Small',
            'units' => 10,
        ]);
        ProductSize::create([
            'product_id' => 1,
            'size' => 'Medium',
            'units' => 20,
        ]);
        ProductSize::create([
            'product_id' => 1,
            'size' => 'Large',
            'units' => 30,
        ]);

        ProductSize::create([
            'product_id' => 2,
            'size' => 'Small',
            'units' => 40,
        ]);
        ProductSize::create([
            'product_id' => 2,
            'size' => 'Medium',
            'units' => 50,
        ]);
        ProductSize::create([
            'product_id' => 2,
            'size' => 'Large',
            'units' => 10,
        ]);

        ProductSize::create([
            'product_id' => 3,
            'size' => 'Small',
            'units' => 20,
        ]);
        ProductSize::create([
            'product_id' => 3,
            'size' => 'Medium',
            'units' => 30,
        ]);
        ProductSize::create([
            'product_id' => 3,
            'size' => 'Large',
            'units' => 40,
        ]);

        ProductSize::create([
            'product_id' => 4,
            'size' => 'Small',
            'units' => 50,
        ]);
        ProductSize::create([
            'product_id' => 4,
            'size' => 'Medium',
            'units' => 10,
        ]);
        ProductSize::create([
            'product_id' => 4,
            'size' => 'Large',
            'units' => 20,
        ]);

        ProductSize::create([
            'product_id' => 5,
            'size' => 'Small',
            'units' => 30,
        ]);
        ProductSize::create([
            'product_id' => 5,
            'size' => 'Medium',
            'units' => 40,
        ]);
        ProductSize::create([
            'product_id' => 5,
            'size' => 'Large',
            'units' => 50,
        ]);
    }
}

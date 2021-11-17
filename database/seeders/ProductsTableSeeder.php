<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Orange Blouse',
            'code' => '150015',
            'details' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, maiores laboriosam. Nobis quidem eaque doloremque laboriosam, suscipit natus ad accusantium maxime tempora. Quos eveniet odit exercitationem numquam reiciendis voluptatem officia maxime repellendus inventore molestiae asperiores rerum dignissimos deserunt neque blanditiis magnam illo soluta tempora molestias et facilis, incidunt provident. Asperiores error nihil quibusdam quos numquam, molestias corrupti suscipit. Ad doloribus cum fugiat dolore. Doloremque laborum perspiciatis consequuntur recusandae reprehenderit maiores consectetur consequatur minima deserunt. Cupiditate tempora repudiandae quas placeat odio laborum illum facere ea recusandae provident dolorum est ex sapiente voluptates maiores, eius vel obcaecati quis vitae. Cum, nobis veritatis?',
            'price' => 100,
            // 'category' => 'Blouses',
            'sale' => true
        ]);

        Product::create([
            'name' => 'Long Coat',
            'code' => '150016',
            'details' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, maiores laboriosam. Nobis quidem eaque doloremque laboriosam, suscipit natus ad accusantium maxime tempora. Quos eveniet odit exercitationem numquam reiciendis voluptatem officia maxime repellendus inventore molestiae asperiores rerum dignissimos deserunt neque blanditiis magnam illo soluta tempora molestias et facilis, incidunt provident. Asperiores error nihil quibusdam quos numquam, molestias corrupti suscipit. Ad doloribus cum fugiat dolore. Doloremque laborum perspiciatis consequuntur recusandae reprehenderit maiores consectetur consequatur minima deserunt. Cupiditate tempora repudiandae quas placeat odio laborum illum facere ea recusandae provident dolorum est ex sapiente voluptates maiores, eius vel obcaecati quis vitae. Cum, nobis veritatis?',
            'price' => 100,
            // 'category' => 'Coats',
            'sale' => true
        ]);

        Product::create([
            'name' => 'Winter Cardigan',
            'code' => '150017',
            'details' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, maiores laboriosam. Nobis quidem eaque doloremque laboriosam, suscipit natus ad accusantium maxime tempora. Quos eveniet odit exercitationem numquam reiciendis voluptatem officia maxime repellendus inventore molestiae asperiores rerum dignissimos deserunt neque blanditiis magnam illo soluta tempora molestias et facilis, incidunt provident. Asperiores error nihil quibusdam quos numquam, molestias corrupti suscipit. Ad doloribus cum fugiat dolore. Doloremque laborum perspiciatis consequuntur recusandae reprehenderit maiores consectetur consequatur minima deserunt. Cupiditate tempora repudiandae quas placeat odio laborum illum facere ea recusandae provident dolorum est ex sapiente voluptates maiores, eius vel obcaecati quis vitae. Cum, nobis veritatis?',
            'price' => 300,
            // 'category' => 'Cardigans',
            'sale' => false
        ]);

        Product::create([
            'name' => 'Summer Cardigan',
            'code' => '150018',
            'details' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, maiores laboriosam. Nobis quidem eaque doloremque laboriosam, suscipit natus ad accusantium maxime tempora. Quos eveniet odit exercitationem numquam reiciendis voluptatem officia maxime repellendus inventore molestiae asperiores rerum dignissimos deserunt neque blanditiis magnam illo soluta tempora molestias et facilis, incidunt provident. Asperiores error nihil quibusdam quos numquam, molestias corrupti suscipit. Ad doloribus cum fugiat dolore. Doloremque laborum perspiciatis consequuntur recusandae reprehenderit maiores consectetur consequatur minima deserunt. Cupiditate tempora repudiandae quas placeat odio laborum illum facere ea recusandae provident dolorum est ex sapiente voluptates maiores, eius vel obcaecati quis vitae. Cum, nobis veritatis?',
            'price' => 400,
            // 'category' => 'Cardigans',
            'sale' => false
        ]);

        Product::create([
            'name' => 'Blue Dress',
            'code' => '150019',
            'details' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quod, maiores laboriosam. Nobis quidem eaque doloremque laboriosam, suscipit natus ad accusantium maxime tempora. Quos eveniet odit exercitationem numquam reiciendis voluptatem officia maxime repellendus inventore molestiae asperiores rerum dignissimos deserunt neque blanditiis magnam illo soluta tempora molestias et facilis, incidunt provident. Asperiores error nihil quibusdam quos numquam, molestias corrupti suscipit. Ad doloribus cum fugiat dolore. Doloremque laborum perspiciatis consequuntur recusandae reprehenderit maiores consectetur consequatur minima deserunt. Cupiditate tempora repudiandae quas placeat odio laborum illum facere ea recusandae provident dolorum est ex sapiente voluptates maiores, eius vel obcaecati quis vitae. Cum, nobis veritatis?',
            'price' => 500,
            // 'category' => 'Dresses',
            'sale' => true
        ]);
    }
}

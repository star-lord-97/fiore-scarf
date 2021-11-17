<?php

namespace Database\Seeders;

use App\Models\PromoCode;
use Illuminate\Database\Seeder;

class PromoCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PromoCode::create([
            'code' => 'ABC123',
            'type' => 'fixed',
            'value' => 30,
            'expires_after' => 3
        ]);

        PromoCode::create([
            'code' => 'DEF456',
            'type' => 'percent',
            'percent_off' => 12.5,
            'expires_after' => 3
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test Admin 1',
            'email' => 'testadmin1@fiore-scarf.com',
            'phone' => '0123456789',
            'address' => 'Admin',
            'city' => 'Adminia',
            'is_admin' => true,
            'password' => Hash::make('admin1admin1'),
        ]);

        User::create([
            'name' => 'Test Admin 2',
            'email' => 'testadmin2@fiore-scarf.com',
            'phone' => '0123456789',
            'address' => 'Admin',
            'city' => 'Adminia',
            'is_admin' => true,
            'password' => Hash::make('admin2admin2'),
        ]);

        User::create([
            'name' => 'Test User 1',
            'email' => 'testuser1@test.test',
            'phone' => '0123456789',
            'address' => 'Test',
            'city' => 'Testania',
            'is_admin' => false,
            'password' => Hash::make('user1user1'),
        ]);

        User::create([
            'name' => 'Test User 2',
            'email' => 'testuser2@test.test',
            'phone' => '0123456789',
            'address' => 'Test',
            'city' => 'Testania',
            'is_admin' => false,
            'password' => Hash::make('user2user2'),
        ]);
    }
}

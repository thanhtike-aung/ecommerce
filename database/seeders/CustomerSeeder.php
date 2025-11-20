<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}

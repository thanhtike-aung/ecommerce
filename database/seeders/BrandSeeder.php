<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Nike',
            'slug' => 'nike',
            'thumbnail' => 'https://via.placeholder.com/150',
            'description' => 'A multinational corporation that designs, develops, and sells athletic footwear, apparel, equipment, and accessories worldwide.',
            'status' => 1,
            'featured' => 1,
            'sort' => 1,
        ]);
        Brand::create([
            'name' => 'Adidas',
            'slug' => 'adidas',
            'thumbnail' => 'https://via.placeholder.com/150',
            'description' => 'A German multinational corporation specializing in athletic footwear, apparel, and accessories, founded in 1949 by Adolf "Adi" Dassler.',
            'status' => 1,
            'featured' => 1,
            'sort' => 1,
        ]);
        Brand::create([
            'name' => 'Puma',
            'slug' => 'puma',
            'thumbnail' => 'https://via.placeholder.com/150',
            'description' => 'Relentlessly pushing sports and culture forward by creating the fastest products for the world’s fastest athletes. Since 1948, PUMA has drawn strength and credibility from its heritage in sports.',
            'status' => 1,
            'featured' => 1,
            'sort' => 1,
        ]);
        Brand::create([
            'name' => 'New Balance',
            'slug' => 'new-balance',
            'thumbnail' => 'https://via.placeholder.com/150',
            'description' => 'An American athletic and casual footwear and apparel brand known for its commitment to quality, craftsmanship, and comfort.',
            'status' => 1,
            'featured' => 1,
            'sort' => 1,
        ]);
        Brand::create([
            'name' => 'Converse',
            'slug' => 'converse',
            'thumbnail' => 'https://via.placeholder.com/150',
            'description' => 'An American footwear brand owned by Nike, Inc., which produces lifestyle shoes, apparel, and accessories, or it can describe the act of having a conversation or a reversed relationship in logic and mathematics.',
            'status' => 1,
            'featured' => 1,
            'sort' => 1,
        ]);
    }
}

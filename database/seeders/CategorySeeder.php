<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'id' => 1,
            'name' => 'Topwear',
            'slug' => 'topwear',
            'thumbnail' => 'categories/topwear.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 2,
            'name' => 'Outerwear',
            'slug' => 'outerwear',
            'thumbnail' => 'categories/outerwear.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 3,
            'name' => 'Bottomwear',
            'slug' => 'bottomwear',
            'thumbnail' => 'categories/bottomwear.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 4,
            'name' => 'Footwear',
            'slug' => 'footwear',
            'thumbnail' => 'categories/footwear.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 5,
            'name' => 'Accessories',
            'slug' => 'accessories',
            'thumbnail' => 'categories/accessories.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 6,
            'name' => 'Tees',
            'slug' => 'tees',
            'parent_id' => 1,
            'thumbnail' => 'categories/tees.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 7,
            'name' => 'Shirts',
            'slug' => 'shirts',
            'parent_id' => 1,
            'thumbnail' => 'categories/shirts.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 8,
            'name' => 'Jeans',
            'slug' => 'jeans',
            'parent_id' => 2,
            'thumbnail' => 'categories/jeans.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 9,
            'name' => 'Shorts',
            'slug' => 'shorts',
            'parent_id' => 2,
            'thumbnail' => 'categories/shorts.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 10,
            'name' => 'Cargo',
            'slug' => 'cargo',
            'parent_id' => 2,
            'thumbnail' => 'categories/cargo.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 11,
            'name' => 'Shoes',
            'slug' => 'shoes',
            'parent_id' => 4,
            'thumbnail' => 'categories/shoes.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 12,
            'name' => 'Socks',
            'slug' => 'socks',
            'parent_id' => 3,
            'thumbnail' => 'categories/socks.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 13,
            'name' => 'Bags',
            'slug' => 'bags',
            'parent_id' => 5,
            'thumbnail' => 'categories/bags.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 14,
            'name' => 'Wallets',
            'slug' => 'wallets',
            'parent_id' => 5,
            'thumbnail' => 'categories/wallets.png',
            'status' => true,
        ]);

        Category::create([
            'id' => 15,
            'name' => 'Watches',
            'slug' => 'watches',
            'parent_id' => 5,
            'thumbnail' => 'categories/watches.png',
            'status' => true,
        ]);
    }
}

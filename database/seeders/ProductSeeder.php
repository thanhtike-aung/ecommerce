<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {

        Product::create([
            'name' => 'Nike Air Max 90',
            'slug' => 'nike-air-max-90',
            'sku' => 'SKU001',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 72.3,
            'sale_price' => 114.44,
            'stock_qty' => 58,
            'thumbnail' => 'products/nike-air-max-90.jpg',
            'category_id' => 11,
            'brand_id' => 1,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Adidas Ultraboost 22',
            'slug' => 'adidas-ultraboost-22',
            'sku' => 'SKU002',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 226.24,
            'sale_price' => 190.24,
            'stock_qty' => 84,
            'thumbnail' => 'products/adidas-ultraboost-22.jpg',
            'category_id' => 11,
            'brand_id' => 2,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'New Balance 530',
            'slug' => 'new-balance-530',
            'sku' => 'SKU003',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 23.41,
            'sale_price' => 196.86,
            'stock_qty' => 99,
            'thumbnail' => 'products/new-balance-530.jpg',
            'category_id' => 11,
            'brand_id' => 3,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Converse Chuck 70',
            'slug' => 'converse-chuck-70',
            'sku' => 'SKU004',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 238.95,
            'sale_price' => 54.61,
            'stock_qty' => 264,
            'thumbnail' => 'products/converse-chuck-70.jpg',
            'category_id' => 11,
            'brand_id' => 4,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Puma Suede Classic',
            'slug' => 'puma-suede-classic',
            'sku' => 'SKU005',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 146.27,
            'sale_price' => 172.35,
            'stock_qty' => 118,
            'thumbnail' => 'products/puma-suede-classic.jpg',
            'category_id' => 11,
            'brand_id' => 5,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Vans Old Skool',
            'slug' => 'vans-old-skool',
            'sku' => 'SKU006',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 232.75,
            'sale_price' => 38.72,
            'stock_qty' => 109,
            'thumbnail' => 'products/vans-old-skool.jpg',
            'category_id' => 11,
            'brand_id' => 6,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Uniqlo U Crew Neck Tee',
            'slug' => 'uniqlo-u-crew-neck-tee',
            'sku' => 'SKU007',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 40.45,
            'sale_price' => 162.49,
            'stock_qty' => 202,
            'thumbnail' => 'products/uniqlo-u-crew-neck-tee.jpg',
            'category_id' => 6,
            'brand_id' => 7,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'H&M Cotton Tee',
            'slug' => 'h&m-cotton-tee',
            'sku' => 'SKU008',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 237.47,
            'sale_price' => 185.16,
            'stock_qty' => 29,
            'thumbnail' => 'products/h&m-cotton-tee.jpg',
            'category_id' => 6,
            'brand_id' => 8,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Zara Graphic Tee',
            'slug' => 'zara-graphic-tee',
            'sku' => 'SKU009',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 108.34,
            'sale_price' => 56.8,
            'stock_qty' => 198,
            'thumbnail' => 'products/zara-graphic-tee.jpg',
            'category_id' => 6,
            'brand_id' => 9,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Carhartt Pocket Tee',
            'slug' => 'carhartt-pocket-tee',
            'sku' => 'SKU010',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 178.47,
            'sale_price' => 113.67,
            'stock_qty' => 141,
            'thumbnail' => 'products/carhartt-pocket-tee.jpg',
            'category_id' => 6,
            'brand_id' => 10,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Champion Reverse Weave Tee',
            'slug' => 'champion-reverse-weave-tee',
            'sku' => 'SKU011',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 182.79,
            'sale_price' => 21.87,
            'stock_qty' => 117,
            'thumbnail' => 'products/champion-reverse-weave-tee.jpg',
            'category_id' => 6,
            'brand_id' => 11,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'H&M Oxford Shirt',
            'slug' => 'h&m-oxford-shirt',
            'sku' => 'SKU012',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 77.81,
            'sale_price' => 124.34,
            'stock_qty' => 165,
            'thumbnail' => 'products/h&m-oxford-shirt.jpg',
            'category_id' => 7,
            'brand_id' => 8,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Uniqlo Easy Care Shirt',
            'slug' => 'uniqlo-easy-care-shirt',
            'sku' => 'SKU013',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 63.42,
            'sale_price' => 28.82,
            'stock_qty' => 207,
            'thumbnail' => 'products/uniqlo-easy-care-shirt.jpg',
            'category_id' => 7,
            'brand_id' => 7,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Zara Linen Shirt',
            'slug' => 'zara-linen-shirt',
            'sku' => 'SKU014',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 23.53,
            'sale_price' => 49.74,
            'stock_qty' => 119,
            'thumbnail' => 'products/zara-linen-shirt.jpg',
            'category_id' => 7,
            'brand_id' => 9,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Gap Button-Down Shirt',
            'slug' => 'gap-button-down-shirt',
            'sku' => 'SKU015',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 144.82,
            'sale_price' => 77.05,
            'stock_qty' => 180,
            'thumbnail' => 'products/gap-button-down-shirt.jpg',
            'category_id' => 7,
            'brand_id' => 12,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Carhartt Herringbone Shirt',
            'slug' => 'carhartt-herringbone-shirt',
            'sku' => 'SKU016',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 177.89,
            'sale_price' => 180.27,
            'stock_qty' => 200,
            'thumbnail' => 'products/carhartt-herringbone-shirt.jpg',
            'category_id' => 7,
            'brand_id' => 10,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Levi’s 511 Jeans',
            'slug' => 'levis-511-jeans',
            'sku' => 'SKU017',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 190.56,
            'sale_price' => 11.21,
            'stock_qty' => 180,
            'thumbnail' => 'products/levis-511-jeans.jpg',
            'category_id' => 8,
            'brand_id' => 12,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Levi’s 501 Jeans',
            'slug' => 'levis-501-jeans',
            'sku' => 'SKU018',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 83.6,
            'sale_price' => 118.51,
            'stock_qty' => 190,
            'thumbnail' => 'products/levis-501-jeans.jpg',
            'category_id' => 8,
            'brand_id' => 12,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Zara Skinny Jeans',
            'slug' => 'zara-skinny-jeans',
            'sku' => 'SKU019',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 216.76,
            'sale_price' => 42.85,
            'stock_qty' => 89,
            'thumbnail' => 'products/zara-skinny-jeans.jpg',
            'category_id' => 8,
            'brand_id' => 9,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Uniqlo Selvedge Jeans',
            'slug' => 'uniqlo-selvedge-jeans',
            'sku' => 'SKU020',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 102.96,
            'sale_price' => 81.96,
            'stock_qty' => 73,
            'thumbnail' => 'products/uniqlo-selvedge-jeans.jpg',
            'category_id' => 8,
            'brand_id' => 7,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Carhartt Tapered Jeans',
            'slug' => 'carhartt-tapered-jeans',
            'sku' => 'SKU021',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 75.76,
            'sale_price' => 87.46,
            'stock_qty' => 36,
            'thumbnail' => 'products/carhartt-tapered-jeans.jpg',
            'category_id' => 8,
            'brand_id' => 10,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Nike Flex Shorts',
            'slug' => 'nike-flex-shorts',
            'sku' => 'SKU022',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 209.92,
            'sale_price' => 197.64,
            'stock_qty' => 175,
            'thumbnail' => 'products/nike-flex-shorts.jpg',
            'category_id' => 9,
            'brand_id' => 1,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Adidas Woven Shorts',
            'slug' => 'adidas-woven-shorts',
            'sku' => 'SKU023',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 79.99,
            'sale_price' => 85.28,
            'stock_qty' => 268,
            'thumbnail' => 'products/adidas-woven-shorts.jpg',
            'category_id' => 9,
            'brand_id' => 2,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Puma Training Shorts',
            'slug' => 'puma-training-shorts',
            'sku' => 'SKU024',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 173.2,
            'sale_price' => 185.55,
            'stock_qty' => 238,
            'thumbnail' => 'products/puma-training-shorts.jpg',
            'category_id' => 9,
            'brand_id' => 5,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Zara Cargo Shorts',
            'slug' => 'zara-cargo-shorts',
            'sku' => 'SKU025',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 115.41,
            'sale_price' => 73.4,
            'stock_qty' => 183,
            'thumbnail' => 'products/zara-cargo-shorts.jpg',
            'category_id' => 9,
            'brand_id' => 9,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'H&M Casual Shorts',
            'slug' => 'h&m-casual-shorts',
            'sku' => 'SKU026',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 230.31,
            'sale_price' => 30.79,
            'stock_qty' => 273,
            'thumbnail' => 'products/h&m-casual-shorts.jpg',
            'category_id' => 9,
            'brand_id' => 8,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Carhartt Cargo Pants',
            'slug' => 'carhartt-cargo-pants',
            'sku' => 'SKU027',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 101.68,
            'sale_price' => 44.07,
            'stock_qty' => 231,
            'thumbnail' => 'products/carhartt-cargo-pants.jpg',
            'category_id' => 10,
            'brand_id' => 10,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Nike Cargo Pants',
            'slug' => 'nike-cargo-pants',
            'sku' => 'SKU028',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 192.27,
            'sale_price' => 72.03,
            'stock_qty' => 166,
            'thumbnail' => 'products/nike-cargo-pants.jpg',
            'category_id' => 10,
            'brand_id' => 1,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Uniqlo Cargo Pants',
            'slug' => 'uniqlo-cargo-pants',
            'sku' => 'SKU029',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 228.56,
            'sale_price' => 87.84,
            'stock_qty' => 110,
            'thumbnail' => 'products/uniqlo-cargo-pants.jpg',
            'category_id' => 10,
            'brand_id' => 7,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Zara Cargo Pants',
            'slug' => 'zara-cargo-pants',
            'sku' => 'SKU030',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 109.73,
            'sale_price' => 106.64,
            'stock_qty' => 237,
            'thumbnail' => 'products/zara-cargo-pants.jpg',
            'category_id' => 10,
            'brand_id' => 9,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Dickies Cargo Pants',
            'slug' => 'dickies-cargo-pants',
            'sku' => 'SKU031',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 168.89,
            'sale_price' => 196.47,
            'stock_qty' => 140,
            'thumbnail' => 'products/dickies-cargo-pants.jpg',
            'category_id' => 10,
            'brand_id' => 13,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Stance Crew Socks',
            'slug' => 'stance-crew-socks',
            'sku' => 'SKU032',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 47.33,
            'sale_price' => 45.18,
            'stock_qty' => 289,
            'thumbnail' => 'products/stance-crew-socks.jpg',
            'category_id' => 12,
            'brand_id' => 14,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Nike Everyday Socks',
            'slug' => 'nike-everyday-socks',
            'sku' => 'SKU033',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 74.54,
            'sale_price' => 83.73,
            'stock_qty' => 163,
            'thumbnail' => 'products/nike-everyday-socks.jpg',
            'category_id' => 12,
            'brand_id' => 1,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Adidas Performance Socks',
            'slug' => 'adidas-performance-socks',
            'sku' => 'SKU034',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 112.85,
            'sale_price' => 122.13,
            'stock_qty' => 119,
            'thumbnail' => 'products/adidas-performance-socks.jpg',
            'category_id' => 12,
            'brand_id' => 2,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Uniqlo Ankle Socks',
            'slug' => 'uniqlo-ankle-socks',
            'sku' => 'SKU035',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 179.79,
            'sale_price' => 19.25,
            'stock_qty' => 128,
            'thumbnail' => 'products/uniqlo-ankle-socks.jpg',
            'category_id' => 12,
            'brand_id' => 7,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Puma Classic Socks',
            'slug' => 'puma-classic-socks',
            'sku' => 'SKU036',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 225.53,
            'sale_price' => 72.33,
            'stock_qty' => 96,
            'thumbnail' => 'products/puma-classic-socks.jpg',
            'category_id' => 12,
            'brand_id' => 5,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Herschel Backpack',
            'slug' => 'herschel-backpack',
            'sku' => 'SKU037',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 163.46,
            'sale_price' => 54.2,
            'stock_qty' => 165,
            'thumbnail' => 'products/herschel-backpack.jpg',
            'category_id' => 13,
            'brand_id' => 15,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Nike Sports Backpack',
            'slug' => 'nike-sports-backpack',
            'sku' => 'SKU038',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 207.22,
            'sale_price' => 10.17,
            'stock_qty' => 35,
            'thumbnail' => 'products/nike-sports-backpack.jpg',
            'category_id' => 13,
            'brand_id' => 1,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Adidas Travel Bag',
            'slug' => 'adidas-travel-bag',
            'sku' => 'SKU039',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 143.79,
            'sale_price' => 103.03,
            'stock_qty' => 80,
            'thumbnail' => 'products/adidas-travel-bag.jpg',
            'category_id' => 13,
            'brand_id' => 2,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Carhartt Tool Bag',
            'slug' => 'carhartt-tool-bag',
            'sku' => 'SKU040',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 200.79,
            'sale_price' => 179.64,
            'stock_qty' => 155,
            'thumbnail' => 'products/carhartt-tool-bag.jpg',
            'category_id' => 13,
            'brand_id' => 10,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Zara Mini Backpack',
            'slug' => 'zara-mini-backpack',
            'sku' => 'SKU041',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 243.26,
            'sale_price' => 192.94,
            'stock_qty' => 232,
            'thumbnail' => 'products/zara-mini-backpack.jpg',
            'category_id' => 13,
            'brand_id' => 9,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Bellroy Slim Wallet',
            'slug' => 'bellroy-slim-wallet',
            'sku' => 'SKU042',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 193.89,
            'sale_price' => 101.14,
            'stock_qty' => 136,
            'thumbnail' => 'products/bellroy-slim-wallet.jpg',
            'category_id' => 14,
            'brand_id' => 16,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Fossil Leather Wallet',
            'slug' => 'fossil-leather-wallet',
            'sku' => 'SKU043',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 27.45,
            'sale_price' => 80.35,
            'stock_qty' => 230,
            'thumbnail' => 'products/fossil-leather-wallet.jpg',
            'category_id' => 14,
            'brand_id' => 17,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Tommy Hilfiger Wallet',
            'slug' => 'tommy-hilfiger-wallet',
            'sku' => 'SKU044',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 201.4,
            'sale_price' => 30.88,
            'stock_qty' => 109,
            'thumbnail' => 'products/tommy-hilfiger-wallet.jpg',
            'category_id' => 14,
            'brand_id' => 18,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Herschel Card Wallet',
            'slug' => 'herschel-card-wallet',
            'sku' => 'SKU045',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 38.32,
            'sale_price' => 47.86,
            'stock_qty' => 131,
            'thumbnail' => 'products/herschel-card-wallet.jpg',
            'category_id' => 14,
            'brand_id' => 15,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Zara Minimal Wallet',
            'slug' => 'zara-minimal-wallet',
            'sku' => 'SKU046',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 86.92,
            'sale_price' => 37.95,
            'stock_qty' => 32,
            'thumbnail' => 'products/zara-minimal-wallet.jpg',
            'category_id' => 14,
            'brand_id' => 9,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Casio G-Shock',
            'slug' => 'casio-g-shock',
            'sku' => 'SKU047',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 117.65,
            'sale_price' => 151.58,
            'stock_qty' => 119,
            'thumbnail' => 'products/casio-g-shock.jpg',
            'category_id' => 15,
            'brand_id' => 19,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Timex Expedition',
            'slug' => 'timex-expedition',
            'sku' => 'SKU048',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 139.37,
            'sale_price' => 137.27,
            'stock_qty' => 197,
            'thumbnail' => 'products/timex-expedition.jpg',
            'category_id' => 15,
            'brand_id' => 20,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Fossil Minimalist Watch',
            'slug' => 'fossil-minimalist-watch',
            'sku' => 'SKU049',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 247.04,
            'sale_price' => 16.16,
            'stock_qty' => 209,
            'thumbnail' => 'products/fossil-minimalist-watch.jpg',
            'category_id' => 15,
            'brand_id' => 17,
            'status' => true,
            'featured' => true,
        ]);


        Product::create([
            'name' => 'Seiko 5 Automatic',
            'slug' => 'seiko-5-automatic',
            'sku' => 'SKU050',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 155.38,
            'sale_price' => 52.83,
            'stock_qty' => 228,
            'thumbnail' => 'products/seiko-5-automatic.jpg',
            'category_id' => 15,
            'brand_id' => 21,
            'status' => true,
            'featured' => false,
        ]);


        Product::create([
            'name' => 'Citizen Eco-Drive',
            'slug' => 'citizen-eco-drive',
            'sku' => 'SKU051',
            'short_description' => 'High‑quality product designed for everyday use.',
            'long_description' => 'This product offers durability, style, and exceptional value, crafted with premium materials suitable for daily wear.',
            'price' => 200.43,
            'sale_price' => 60.43,
            'stock_qty' => 179,
            'thumbnail' => 'products/citizen-eco-drive.jpg',
            'category_id' => 15,
            'brand_id' => 22,
            'status' => true,
            'featured' => true,
        ]);
    }
}

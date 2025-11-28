<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::create([
            'id' => 1,
            'name' => 'Nike',
            'slug' => 'nike',
            'thumbnail' => 'brands/nike.png',
            'description' => 'A global leader in athletic footwear, apparel, and sporting equipment.',
            'status' => 1,
            'featured' => 1,
            'sort' => 1,
        ]);

        Brand::create([
            'id' => 2,
            'name' => 'Adidas',
            'slug' => 'adidas',
            'thumbnail' => 'brands/adidas.png',
            'description' => 'A German sportswear brand known for performance footwear and apparel.',
            'status' => 1,
            'featured' => 1,
            'sort' => 2,
        ]);

        Brand::create([
            'id' => 3,
            'name' => 'New Balance',
            'slug' => 'new-balance',
            'thumbnail' => 'brands/new-balance.png',
            'description' => 'An American footwear brand known for comfort-focused running and lifestyle shoes.',
            'status' => 1,
            'featured' => 0,
            'sort' => 3,
        ]);

        Brand::create([
            'id' => 4,
            'name' => 'Converse',
            'slug' => 'converse',
            'thumbnail' => 'brands/converse.png',
            'description' => 'A classic American brand famous for the Chuck Taylor All-Star sneakers.',
            'status' => 1,
            'featured' => 1,
            'sort' => 4,
        ]);

        Brand::create([
            'id' => 5,
            'name' => 'Puma',
            'slug' => 'puma',
            'thumbnail' => 'brands/puma.png',
            'description' => 'A global sportswear company known for athletic shoes and apparel.',
            'status' => 1,
            'featured' => 0,
            'sort' => 5,
        ]);

        Brand::create([
            'id' => 6,
            'name' => 'Vans',
            'slug' => 'vans',
            'thumbnail' => 'brands/vans.png',
            'description' => 'A skateboarding-focused brand producing shoes, clothing, and accessories.',
            'status' => 1,
            'featured' => 0,
            'sort' => 6,
        ]);

        Brand::create([
            'id' => 7,
            'name' => 'Uniqlo',
            'slug' => 'uniqlo',
            'thumbnail' => 'brands/uniqlo.png',
            'description' => 'A Japanese retail brand offering high-quality basics and functional everyday wear.',
            'status' => 1,
            'featured' => 0,
            'sort' => 7,
        ]);

        Brand::create([
            'id' => 8,
            'name' => 'H&M',
            'slug' => 'h&m',
            'thumbnail' => 'brands/h&m.png',
            'description' => 'A global fashion retailer offering trendy and affordable clothing.',
            'status' => 1,
            'featured' => 0,
            'sort' => 8,
        ]);

        Brand::create([
            'id' => 9,
            'name' => 'Zara',
            'slug' => 'zara',
            'thumbnail' => 'brands/zara.png',
            'description' => 'A leading fast-fashion brand known for modern, trend-driven designs.',
            'status' => 1,
            'featured' => 0,
            'sort' => 9,
        ]);

        Brand::create([
            'id' => 10,
            'name' => 'Carhartt',
            'slug' => 'carhartt',
            'thumbnail' => 'brands/carhartt.png',
            'description' => 'A rugged workwear brand known for durable jackets, pants, and accessories.',
            'status' => 1,
            'featured' => 1,
            'sort' => 10,
        ]);

        Brand::create([
            'id' => 11,
            'name' => 'Champion',
            'slug' => 'champion',
            'thumbnail' => 'brands/champion.png',
            'description' => 'A sportswear manufacturer known for athletic apparel and iconic sweatshirts.',
            'status' => 1,
            'featured' => 0,
            'sort' => 11,
        ]);

        Brand::create([
            'id' => 12,
            'name' => 'Gap',
            'slug' => 'gap',
            'thumbnail' => 'brands/gap.png',
            'description' => 'An American clothing brand known for casual essentials and denim.',
            'status' => 1,
            'featured' => 0,
            'sort' => 12,
        ]);

        Brand::create([
            'id' => 13,
            'name' => 'Dickies',
            'slug' => 'dickies',
            'thumbnail' => 'brands/dickies.png',
            'description' => 'A workwear brand recognized for durable apparel including pants and overalls.',
            'status' => 1,
            'featured' => 0,
            'sort' => 13,
        ]);

        Brand::create([
            'id' => 14,
            'name' => 'Stance',
            'slug' => 'stance',
            'thumbnail' => 'brands/stance.png',
            'description' => 'A lifestyle sock and apparel brand known for bold designs and comfort.',
            'status' => 1,
            'featured' => 0,
            'sort' => 14,
        ]);

        Brand::create([
            'id' => 15,
            'name' => 'Herschel',
            'slug' => 'herschel',
            'thumbnail' => 'brands/herschel.png',
            'description' => 'A Canadian accessories brand known for backpacks, bags, and lifestyle gear.',
            'status' => 1,
            'featured' => 1,
            'sort' => 15,
        ]);

        Brand::create([
            'id' => 16,
            'name' => 'Bellroy',
            'slug' => 'bellroy',
            'thumbnail' => 'brands/bellroy.png',
            'description' => 'A premium accessories brand specializing in slim wallets and everyday carry items.',
            'status' => 1,
            'featured' => 1,
            'sort' => 16,
        ]);

        Brand::create([
            'id' => 17,
            'name' => 'Fossil',
            'slug' => 'fossil',
            'thumbnail' => 'brands/fossil.png',
            'description' => 'A lifestyle brand producing watches, wallets, bags, and accessories.',
            'status' => 1,
            'featured' => 1,
            'sort' => 17,
        ]);

        Brand::create([
            'id' => 18,
            'name' => 'Tommy Hilfiger',
            'slug' => 'tommy-hilfiger',
            'thumbnail' => 'brands/tommy-hilfiger.png',
            'description' => 'A global American fashion brand known for classic premium clothing and accessories.',
            'status' => 1,
            'featured' => 0,
            'sort' => 18,
        ]);

        Brand::create([
            'id' => 19,
            'name' => 'Casio',
            'slug' => 'casio',
            'thumbnail' => 'brands/casio.png',
            'description' => 'A Japanese electronics brand recognized for watches, calculators, and digital devices.',
            'status' => 1,
            'featured' => 1,
            'sort' => 19,
        ]);

        Brand::create([
            'id' => 20,
            'name' => 'Timex',
            'slug' => 'timex',
            'thumbnail' => 'brands/timex.png',
            'description' => 'An American watch brand offering durable, affordable timepieces.',
            'status' => 1,
            'featured' => 0,
            'sort' => 20,
        ]);

        Brand::create([
            'id' => 21,
            'name' => 'Seiko',
            'slug' => 'seiko',
            'thumbnail' => 'brands/seiko.png',
            'description' => 'A Japanese watchmaker known for precision craftsmanship and automatic movements.',
            'status' => 1,
            'featured' => 0,
            'sort' => 21,
        ]);

        Brand::create([
            'id' => 22,
            'name' => 'Citizen',
            'slug' => 'citizen',
            'thumbnail' => 'brands/citizen.png',
            'description' => 'A watch manufacturer known for Eco-Drive solar-powered timepieces.',
            'status' => 1,
            'featured' => 0,
            'sort' => 22,
        ]);
    }
}

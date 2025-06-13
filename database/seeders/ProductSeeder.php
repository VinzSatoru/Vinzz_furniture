<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'category_id' => 1, // Kursi
                'name' => 'Kursi Gaming Pro',
                'description' => 'Kursi gaming ergonomis dengan bantalan empuk dan dukungan lumbar',
                'price' => 2500000,
                'stock' => 10,
                'image' => 'images/products/chair-1.jpg',
            ],
            [
                'category_id' => 2, // Meja
                'name' => 'Meja Kerja Minimalis',
                'description' => 'Meja kerja modern dengan desain minimalis dan material berkualitas',
                'price' => 1500000,
                'stock' => 15,
                'image' => 'images/products/table-1.jpg',
            ],
            [
                'category_id' => 3, // Lemari
                'name' => 'Lemari Pakaian 3 Pintu',
                'description' => 'Lemari pakaian dengan 3 pintu dan cermin besar',
                'price' => 3500000,
                'stock' => 8,
                'image' => 'images/products/cabinet-1.jpg',
            ],
            [
                'category_id' => 4, // Sofa
                'name' => 'Sofa Set Minimalis',
                'description' => 'Set sofa 3-2-1 dengan bahan berkualitas dan nyaman',
                'price' => 8500000,
                'stock' => 5,
                'image' => 'images/products/sofa-1.jpg',
            ],
            [
                'category_id' => 5, // Tempat Tidur
                'name' => 'Tempat Tidur King Size',
                'description' => 'Tempat tidur king size dengan rangka kokoh dan desain modern',
                'price' => 5000000,
                'stock' => 7,
                'image' => 'images/products/bed-1.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $product['category_id'],
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => $product['image'],
                'is_active' => true,
            ]);
        }
    }
}

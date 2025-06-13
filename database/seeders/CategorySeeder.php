<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Kursi',
                'description' => 'Berbagai jenis kursi untuk rumah dan kantor',
            ],
            [
                'name' => 'Meja',
                'description' => 'Meja makan, meja kerja, dan meja lainnya',
            ],
            [
                'name' => 'Lemari',
                'description' => 'Lemari pakaian, lemari dapur, dan lemari lainnya',
            ],
            [
                'name' => 'Sofa',
                'description' => 'Sofa untuk ruang tamu dan ruang keluarga',
            ],
            [
                'name' => 'Tempat Tidur',
                'description' => 'Tempat tidur dan ranjang untuk kamar tidur',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}

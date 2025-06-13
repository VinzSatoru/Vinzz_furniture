<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Panggil seeder terpisah
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}

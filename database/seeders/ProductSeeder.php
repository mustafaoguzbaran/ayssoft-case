<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\Product::create([
            'name' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'price' => 19.99,
            'sku' => 'SP-001',
        ]);

        \App\Models\Product::create([
            'name' => 'Another Product',
            'description' => 'This is another product description.',
            'price' => 29.99,
            'sku' => 'AP-002',
        ]);

        \App\Models\Product::create([
            'name' => 'Third Product',
            'description' => 'This is the third product description.',
            'price' => 39.99,
            'sku' => 'TP-003',
        ]);
    }

}

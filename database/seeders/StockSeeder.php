<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Stock::create([
            'product_id' => 1,
            'quantity' => 0,
            'branch_id' => 3,
        ]);

        \App\Models\Stock::create([
            'product_id' => 1,
            'quantity' => 0,
            'branch_id' => 2,
        ]);

        \App\Models\Stock::create([
            'product_id' => 1,
            'quantity' => 1,
            'branch_id' => 1,
        ]);

        \App\Models\Stock::create([
            'product_id' => 2,
            'quantity' => 0,
            'branch_id' => 3,
        ]);

        \App\Models\Stock::create([
            'product_id' => 2,
            'quantity' => 1,
            'branch_id' => 2,
        ]);

        \App\Models\Stock::create([
            'product_id' => 2,
            'quantity' => 0,
            'branch_id' => 1,
        ]);

        \App\Models\Stock::create([
            'product_id' => 3,
            'quantity' => 0,
            'branch_id' => 3,
        ]);

        \App\Models\Stock::create([
            'product_id' => 3,
            'quantity' => 0,
            'branch_id' => 2,
        ]);

        \App\Models\Stock::create([
            'product_id' => 3,
            'quantity' => 0,
            'branch_id' => 1,
        ]);
    }

}

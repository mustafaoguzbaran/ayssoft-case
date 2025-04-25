<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Branch::create([
            'name' => 'Main Branch',
            'location' => '123 Main St, Cityville',
            'parent_id' => null,
        ]);

        \App\Models\Branch::create([
            'name' => 'Secondary Branch',
            'location' => '456 Elm St, Townsville',
            'parent_id' => 1,
        ]);

        \App\Models\Branch::create([
            'name' => 'Tertiary Branch',
            'location' => '789 Oak St, Villagetown',
            'parent_id' => 2,
        ]);
    }
}

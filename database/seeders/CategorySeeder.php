<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cotegories = ['Science','Entertainment','Sports'];

        foreach($cotegories as $cotegory)
        {
            Category::create([
                'name' => $cotegory
            ]);
        }
    }
}

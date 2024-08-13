<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['php','laravel php','back end development','front end development'];

        foreach($tags as $tag)
        {
            Tag::create([
                'name' => $tag
            ]);
        }
    }
}

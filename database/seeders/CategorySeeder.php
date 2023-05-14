<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = json_decode(File::get(__DIR__ . "/json/categories.json"));

        foreach ($categories as $category) {
            Category::create([
                "name" => $category->name,
            ]);
        }
    }
}

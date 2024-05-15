<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $categories = array(
            ['id' => 1, 'name' => 'Statue', 'created_at' => now()],
            ['id' => 2, 'name' => 'Carriage', 'created_at' => now()],
            ['id' => 3, 'name' => 'Hanging Crafts', 'created_at' => now()],
            ['id' => 4, 'name' => 'Furniture', 'created_at' => now()],
            ['id' => 5, 'name' => 'Signs', 'created_at' => now()],
            ['id' => 6, 'name' => 'Memento', 'created_at' => now()],
            ['id' => 7, 'name' => 'Logo', 'created_at' => now()],
            ['id' => 8, 'name' => 'Chairs', 'created_at' => now()],
            ['id' => 9, 'name' => 'Keychain', 'created_at' => now()],
            ['id' => 10, 'name' => 'Others', 'created_at' => now()],
        );

        Category::insert($categories);

        Category::all()->each(fn(
            $category) => $service->log_activity(model:$category, event:'added', model_name: 'Category', model_property_name: $category->name)
        );
    }
}
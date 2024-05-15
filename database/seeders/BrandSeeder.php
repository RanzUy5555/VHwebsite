<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $brands = array(
            ['id' => 1, 'name' => 'brand one', 'created_at' => now()],
            ['id' => 2, 'name' => 'brand two', 'created_at' => now()],
            ['id' => 3, 'name' => 'brand three', 'created_at' => now()],
            ['id' => 4, 'name' => 'unbrand', 'created_at' => now()],
        );

        Brand::insert($brands);

        Brand::all()->each(fn(
            $brand) => $service->log_activity(model:$brand, event:'added', model_name: 'Brand', model_property_name: $brand->name)
        );
    }
}
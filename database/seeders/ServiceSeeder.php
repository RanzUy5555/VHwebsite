<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $activity_log_service)
    {
        $services = array(

            [
                'id' => 1,
                'name' => 'Custom Christian Sculptures',
                'description' => "Crafting bespoke sculptures tailored to individual preferences, allowing clients to express their faith through personalized artworks.",
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Restoration and Preservation',
                'description' => "Restoring and preserving antique Christian sculptures, ensuring their longevity and maintaining their spiritual significance for generations to come.
                ",
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Artisan Workshops',
                'description' => "Hosting hands-on workshops where enthusiasts can learn traditional sculpting techniques, fostering creativity and nurturing a deeper connection to the art of Christian craftsmanship.
                ",
                'created_at' => now(),
            ],
        );

        Service::insert($services);

        Service::all()->each(function($service) use($activity_log_service) {
            $service
            ->addMedia(public_path("/tmp_files/services/$service->id.jpg"))
            ->preservingOriginal()
            ->toMediaCollection('service_images');

            $activity_log_service->log_activity(model:$service, event:'added', model_name: 'Service', model_property_name: $service->name);
        });
    }
}
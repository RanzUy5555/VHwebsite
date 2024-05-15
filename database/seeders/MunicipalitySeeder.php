<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $municipalities = [
            [
                'id' => 1,
                'name' => 'Paete',
                'fee' => 0,
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Kalayaan',
                'fee' => 50,
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Pangil',
                'fee' => 50,
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Lumban',
                'fee' => 100,
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Siniloan',
                'fee' => 200,
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Pagsanjan',
                'fee' => 200,
                'created_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Magdalena',
                'fee' => 350,
                'created_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Sta Cruz',
                'fee' => 350,
                'created_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Nagcarlan',
                'fee' => 400,
                'created_at' => now(),
            ],
            [
                'id' => 10,
                'name' => 'Pila',
                'fee' => 450,
                'created_at' => now(),
            ],
            [
                'id' => 11,
                'name' => 'Rizal',
                'fee' => 500,
                'created_at' => now(),
            ],
            [
                'id' => 12,
                'name' => 'Victoria',
                'fee' => 550,
                'created_at' => now(),
            ],
            [
                'id' => 13,
                'name' => 'Los Baños',
                'fee' => 600,
                'created_at' => now(),
            ],
            [
                'id' => 14,
                'name' => 'Calamba',
                'fee' => 650,
                'created_at' => now(),
            ],
            [
                'id' => 15,
                'name' => 'Binan',
                'fee' => 700,
                'created_at' => now(),
            ],
        ];

        Municipality::insert($municipalities);

        Municipality::all()->map(fn(
            $municipality) => $service->log_activity(model:$municipality, event:'added', model_name: 'Municipality', model_property_name: $municipality->name)
        );
    }
}
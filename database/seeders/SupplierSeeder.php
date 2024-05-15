<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $suppliers = array(
            [
                'id' => 1,
                'company' => 'Supplier A',
                'manager' => 'Jessie Sue',
                'contact' => '09659312003', 
                'email' => 'supplierA@gmail.com', 
                'created_at' => now()
            ],
            [
                'id' => 2,
                'company' => 'Supplier B',
                'manager' => 'Michelle Yu',
                'contact' => '09659312003', 
                'email' => 'supplierB@gmail.com', 
                'created_at' => now()
            ],
            [
                'id' => 3,
                'company' => 'Supplier C',
                'manager' => 'Jane Doe',
                'contact' => '09659312003', 
                'email' => 'supplierC@gmail.com', 
                'created_at' => now()
            ],
        );

        Supplier::insert($suppliers);

        Supplier::all()->map(fn(
            $supplier) => $service->log_activity(model:$supplier, event:'added', model_name: 'Supplier', model_property_name: $supplier->company)
        );
    }
}
<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $payment_methods = array(
            [
                'id' => 1,
                'type' => 'Gcash',
                'account_name' => 'Virgilio Handicraft',
                'account_no' => '09279575483',
                'is_online' => true,
                'created_at' => now()
            ],
            [
                'id' => 2,
                'type' => 'Maya',
                'account_name' => 'Virgilio Handicraft',
                'account_no' => '09213087945',
                'is_online' => true,
                'created_at' => now()
            ],
            [
                'id' => 3,
                'type' => 'BDO Bank Transfer',
                'account_name' => 'John Doe',
                'account_no' => '5321 5001 2003 0001',
                'is_online' => false,
                'created_at' => now()
            ],
        );

        PaymentMethod::insert($payment_methods);

        PaymentMethod::all()->each(fn(
            $payment_method) => $service->log_activity(model:$payment_method, event:'added', model_name: 'Payment Method', model_property_name: $payment_method->type)
        );
    }
}
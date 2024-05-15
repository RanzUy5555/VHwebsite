<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Services\ActivityLogsService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $orders = array(
            [
                'id' => 1,
                'user_id' => 2,
                'product_id' => mt_rand(1,4),
                'product_variety_id' => null,
                'qty' => 1,
                'payment_method_id' =>  1,
                'transaction_no' => '548182115',
                'reference_no' => '1000312111',
                'address' => 'Test Address',
                'municipality_id' => mt_rand(1,3),
                'contact' => '09659312005',
                'note' => null,
                'status' => Order::PENDING,
                'remark' => null,
                'created_at' => now()->subYear(),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'product_id' => mt_rand(1,4),
                'product_variety_id' => null,
                'qty' => 1,
                'payment_method_id' =>  1,
                'transaction_no' => '5481821152',
                'reference_no' => '1000312111',
                'address' => 'Test Address',
                'municipality_id' => mt_rand(1,3),
                'contact' => '09659312005',
                'note' => null,
                'status' => Order::APPROVED,
                'remark' => null,
                'created_at' => now()->subMonth(),
            ],
           
            [
                'id' => 3,
                'user_id' => 2,
                'product_id' => mt_rand(1,4),
                'product_variety_id' => null,
                'qty' => 1,
                'payment_method_id' =>  1,
                'transaction_no' => '5481821153',
                'reference_no' => '1000312111',
                'address' => 'Test Address',
                'municipality_id' => mt_rand(1,3),
                'contact' => '09659312005',
                'note' => null,
                'status' => Order::ON_DELIVERY,
                'remark' => null,
                'created_at' => now()->subMonth(),
            ],
           
            [
                'id' => 4,
                'user_id' => 2,
                'product_id' => mt_rand(1,4),
                'product_variety_id' => null,
                'qty' => 1,
                'payment_method_id' =>  1,
                'transaction_no' => '5481821154',
                'reference_no' => '1000312111',
                'address' => 'Test Address',
                'municipality_id' => mt_rand(1,3),
                'contact' => '09659312005',
                'note' => null,
                'status' => Order::ON_DELIVERY,
                'remark' => null,
                'created_at' => now()->subMonth(),
            ],
           
            [
                'id' => 5,
                'user_id' => 2,
                'product_id' => mt_rand(1,4),
                'product_variety_id' => null,
                'qty' => 1,
                'payment_method_id' =>  1,
                'transaction_no' => '5481821155',
                'reference_no' => '1000312111',
                'address' => 'Test Address',
                'municipality_id' => mt_rand(1,3),
                'contact' => '09659312005',
                'note' => null,
                'status' => Order::REJECTED,
                'remark' => null,
                'created_at' => now()->subMonth(),
            ],
           
            [
                'id' => 6,
                'user_id' => 2,
                'product_id' => mt_rand(1,4),
                'product_variety_id' => null,
                'qty' => 1,
                'payment_method_id' =>  1,
                'transaction_no' => '5481821156',
                'reference_no' => '1000312111',
                'address' => 'Test Address',
                'municipality_id' => mt_rand(1,3),
                'contact' => '09659312005',
                'note' => null,
                'status' => Order::REJECTED,
                'remark' => null,
                'created_at' => now()->subMonth(),
            ],


            [
                'id' => 7,
                'user_id' => 2,
                'product_id' => mt_rand(1,4),
                'product_variety_id' => null,
                'qty' => 1,
                'payment_method_id' =>  1,
                'transaction_no' => '54818211520',
                'reference_no' => '1000312113',
                'address' => 'Test Address',
                'municipality_id' => mt_rand(1,3),
                'contact' => '09659312005',
                'note' => null,
                'status' => Order::DELIVERED,
                'remark' => null,
                'created_at' => now()->subMonth(),
            ],
            [
                'id' => 8,
                'user_id' => 2,
                'product_id' => mt_rand(1,4),
                'product_variety_id' => null,
                'qty' => 1,
                'payment_method_id' =>  1,
                'transaction_no' => '54818211521',
                'reference_no' => '10003121134',
                'address' => 'Test Address',
                'municipality_id' => mt_rand(1,3),
                'contact' => '09659312005',
                'note' => null,
                'status' => Order::DELIVERED,
                'remark' => null,
                'created_at' => now()->subMonth(),
            ],
           
          
        );

        Order::insert($orders);

        Order::all()->each(function($order) use($service) {
            
            $order->addMedia(public_path("/tmp_files/gcash.png"))->preservingOriginal()->toMediaCollection('payment_receipts');

            $service->log_activity(model:$order, event:'ordered', model_name: 'Product', model_property_name: $order->transaction_no, end_user: $order->user->full_name);
        });
    }
}
<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Services\ActivityLogsService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $carts = array(
            [
                'id' => 1,
                'user_id' => 2,
                'product_id' => 1,
                'product_variety_id' => null,
                'qty' => 1,
                'created_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'product_id' => 2,
                'product_variety_id' => null,
                'qty' => 1,
                'created_at' => now()
            ],
        );

        Cart::insert($carts);

        Cart::all()->each(fn(
            $cart) => $service->log_activity(model:$cart, event:'added', model_name: 'Product in Cart', model_property_name: $cart->product->name ?? $cart->product_variety->name, end_user: $cart->user->full_name)
        );
    }
}
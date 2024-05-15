<?php

namespace Database\Seeders;

use App\Models\ProductVariety;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductVarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $product_varieties = array(

            // product > Customized / Personalized White T-Shirt Sublimation Print
            [
                'id' => 1,
                'product_id' => 1,
                'name' => 'extra small (XS)',
                'price' => 200.00,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 2,
                'product_id' => 1,
                'name' => 'small (S)',
                'price' => 200.00,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 3,
                'product_id' => 1,
                'name' => 'medium (M)',
                'price' => 200.00,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 4,
                'product_id' => 1,
                'name' => 'large (L)',
                'price' => 200.00,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 5,
                'product_id' => 1,
                'name' => 'extra large (XL)',
                'price' => 250.00,
                'qty' => 20,
                'created_at' => now()
            ],


            
            // product > Customized / Personalized Black T-Shirt Sublimation Print
            [
                'id' => 6,
                'product_id' => 2,
                'name' => 'extra small (XS)',
                'price' => 200.00,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 7,
                'product_id' => 2,
                'name' => 'small (S)',
                'price' => 200.00,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 8,
                'product_id' => 2,
                'name' => 'medium (M)',
                'price' => 200.00,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 9,
                'product_id' => 2,
                'name' => 'large (L)',
                'price' => 200.00,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 10,
                'product_id' => 2,
                'name' => 'extra large (XL)',
                'price' => 250.00,
                'qty' => 20,
                'created_at' => now()
            ],


            // product > Customized Flyers Printing
       
            [
                'id' => 11,
                'product_id' => 5,
                'name' => '1 side | DL 120GSM',
                'price' => 8,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 12,
                'product_id' => 5,
                'name' => '1 side | DL 160GSM',
                'price' => 10,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 13,
                'product_id' => 5,
                'name' => '1 side | A5 120GSM',
                'price' => 10,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 14,
                'product_id' => 5,
                'name' => '1 side | A5 160GSM',
                'price' => 15,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 15,
                'product_id' => 5,
                'name' => '1 side | A6 120GSM',
                'price' => 10,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 16,
                'product_id' => 5,
                'name' => '1 side | A6 160GSM',
                'price' => 15,
                'qty' => 20,
                'created_at' => now()
            ],

            [
                'id' => 17,
                'product_id' => 5,
                'name' => '2 side | DL 120GSM',
                'price' => 10,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 18,
                'product_id' => 5,
                'name' => '2 side | DL 160GSM',
                'price' => 12,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 19,
                'product_id' => 5,
                'name' => '2 side | A5 120GSM',
                'price' => 15,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 20,
                'product_id' => 5,
                'name' => '2 side | A5 160GSM',
                'price' => 20,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 21,
                'product_id' => 5,
                'name' => '2 side | A6 120GSM',
                'price' => 15,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 22,
                'product_id' => 5,
                'name' => '2 side | A6 160GSM',
                'price' => 20,
                'qty' => 20,
                'created_at' => now()
            ],

             // product > Customized Brochure Printing
       
             [
                'id' => 23,
                'product_id' => 6,
                'name' => '1 side | DL 120GSM',
                'price' => 8,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 24,
                'product_id' => 6,
                'name' => '1 side | DL 160GSM',
                'price' => 10,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 25,
                'product_id' => 6,
                'name' => '1 side | A5 120GSM',
                'price' => 10,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 26,
                'product_id' => 6,
                'name' => '1 side | A5 160GSM',
                'price' => 15,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 27,
                'product_id' => 6,
                'name' => '1 side | A6 120GSM',
                'price' => 10,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 28,
                'product_id' => 6,
                'name' => '1 side | A6 160GSM',
                'price' => 15,
                'qty' => 20,
                'created_at' => now()
            ],

            [
                'id' => 29,
                'product_id' => 6,
                'name' => '2 side | DL 120GSM',
                'price' => 10,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 30,
                'product_id' => 6,
                'name' => '2 side | DL 160GSM',
                'price' => 12,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 31,
                'product_id' => 6,
                'name' => '2 side | A5 120GSM',
                'price' => 15,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 32,
                'product_id' => 6,
                'name' => '2 side | A5 160GSM',
                'price' => 20,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 33,
                'product_id' => 6,
                'name' => '2 side | A6 120GSM',
                'price' => 15,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 34,
                'product_id' => 6,
                'name' => '2 side | A6 160GSM',
                'price' => 20,
                'qty' => 20,
                'created_at' => now()
            ],


            // product > Customized Logo Sticker - Consumable A4 Size

            [
                'id' => 35,
                'product_id' => 8,
                'name' => 'Matte',
                'price' => 60,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 36,
                'product_id' => 8,
                'name' => 'Glossy',
                'price' => 60,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 37,
                'product_id' => 8,
                'name' => 'Hologram',
                'price' => 70,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 38,
                'product_id' => 8,
                'name' => 'Broken Glass',
                'price' => 70,
                'qty' => 20,
                'created_at' => now()
            ],
            [
                'id' => 39,
                'product_id' => 8,
                'name' => '3D',
                'price' => 80,
                'qty' => 20,
                'created_at' => now()
            ],
        );

        ProductVariety::insert($product_varieties);

        ProductVariety::all()->each(fn(
            $product_variety) => $service->log_activity(model:$product_variety, event:'added', model_name: 'Product Variety', model_property_name: $product_variety->name)
        );
    }
}
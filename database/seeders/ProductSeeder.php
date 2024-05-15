<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $total_supplier = Supplier::count();
        $total_brand = Brand::count();

        $products = [
            [
                'id' => 1,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Jesus Christ Statue – Sacred Heart – 15 inches',
                'slug' => Str::slug('Jesus Christ Statue – Sacred Heart – 15 inches'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 900,
                'qty' => 20,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 2,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Our Lady of Fatima Statue – 16 inches',
                'slug' => Str::slug('Our Lady of Fatima Statue – 16 inches'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 1300,
                'qty' => 15,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 3,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Sto Nino Statue – 13 inches',
                'slug' => Str::slug('Sto Nino Statue – 13 inches'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 1300,
                'qty' => 10,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 4,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Saint Michael Statue – 10 inches',
                'slug' => Str::slug('Saint Michael Statue – 10 inches'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 1750,
                'qty' => 10,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 5,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Padre Pio Statue – 12 inches',
                'slug' => Str::slug('Padre Pio Statue – 12 inches'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 850,
                'qty' => 20,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 6,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'St. Therese Statue - 9 x 9 x 24 cm',
                'slug' => Str::slug('St. Therese Statue - 9 x 9 x 24 cm'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 1375,
                'qty' => 10,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 7,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Saint Joseph - 12 x 10 x 34 cm',
                'slug' => Str::slug('Saint Joseph - 12 x 10 x 34 cm'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 1600,
                'qty' => 15,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 8,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Saint Augustine Statue – 8 inches',
                'slug' => Str::slug('Saint Augustine Statue – 8 inches'),
                'description' => 'The price range may vary depending on the measurement unit
                (Inches/Centimeter)',
                'price' => 1200,
                'qty' => 10,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 9,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Crucifix Jesus Christ Statue – 15 inches',
                'slug' => Str::slug('Crucifix Jesus Christ Statue – 15 inches'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 1870,
                'qty' => 20,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 10,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'San Roque Statue – 2ft',
                'slug' => Str::slug('San Roque Statue – 2ft'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter)',
                'price' => 3200,
                'qty' => 10,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 11,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Carroza',
                'slug' => Str::slug('Carroza'),
                'description' => 'The price range may vary depending on the material used & Customization request',
                'price' => '15000',
                'qty' => 5,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 12,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Wooden Wall Mural Art',
                'slug' => Str::slug('Wooden Wall Mural Art'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter) & Customization request',
                'price' => 2500,
                'qty' => 30,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 13,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Wooden Antique - Desk',
                'slug' => Str::slug('Wooden Antique - Desk'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter) & Customization request',
                'price' => 8000,
                'qty' => 30,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 14,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Wooden Table Sign',
                'slug' => Str::slug('Wooden Table Sign'),
                'description' => 'The price range may vary depending on the measurement unit (Inches/Centimeter) & Customization request',
                'price' => 500,
                'qty' => 30,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 15,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Wooden Trophies',
                'slug' => Str::slug('Wooden Trophies'),
                'description' => 'The price range may vary depending on the Materials used & Customization request',
                'price' => 500,
                'qty' => 25,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 16,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Wooden Logo',
                'slug' => Str::slug('Wooden Logo'),
                'description' => 'The price range may vary depending on the Materials used & Customization request',
                'price' => 1500,
                'qty' => 30,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 17,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Wooden Chairs',
                'slug' => Str::slug('Wooden Chairs'),
                'description' => 'The price range may vary depending on the Materials used & Customization request',
                'price' => 2500,
                'qty' => 40,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ],
            [
                'id' => 18,
                'supplier_id' => mt_rand(1,$total_supplier),
                'category_id' => mt_rand(1,5),
                'brand_id' => mt_rand(1,4), 
                'code' => mt_rand(123456,999999),
                'name' => 'Room Keychains Laser Mahogany',
                'slug' => Str::slug('Room Keychains Laser Mahogany'),
                'description' => 'The price range may vary depending of Customization request',
                'price' => 250,
                'qty' => 50
                ,
                'is_available' => true,
                'is_customized' => true,
                'created_at' => now()
            ]
        ];
        

        Product::insert($products);

        Product::all()->each(function($product) use($service) {
            //$product->addMedia(public_path("/img/noimg.png"))->preservingOriginal()->toMediaCollection('product_images');
            $product->addMedia(public_path("/tmp_files/products/$product->id.png"))->preservingOriginal()->toMediaCollection('product_images');
            $service->log_activity(model:$product, event:'added', model_name: 'Product', model_property_name: $product->name);
        });
    }
}
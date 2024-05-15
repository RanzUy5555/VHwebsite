<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run Seeders
       
        $this->call([

            /** Start User Management */
                MunicipalitySeeder::class,
                RoleSeeder::class,
                UserSeeder::class,
            /** End User Management */

            /** Start Product Management */
                SupplierSeeder::class,
                CategorySeeder::class,
                BrandSeeder::class,
                ProductSeeder::class,
                // ProductVarietySeeder::class,
            /** End Product Management */

            /** Start Order Management */
                PaymentMethodSeeder::class,
                CartSeeder::class,
                OrderSeeder::class,
            /** End Order Management */


                ServiceSeeder::class,
                RequestSeeder::class,
                ContactSeeder::class,
        ]);

    }
}
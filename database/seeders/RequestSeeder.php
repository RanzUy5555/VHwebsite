<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requests = array(
            [
                'id' => 1, 
                'user_id' => 2, 
                'service_id' => 1, 
                'company' => 'POS Business Globals Inc',
                'message' => "
                Good Day,
                I hope this email finds you well. My name is Tesla and I am reaching out to you on behalf of POS Business Inc.

                We have recently come across your website and are interested in exploring potential business opportunities with your esteemed company. At POS Business Inc, we are committed to providing our customers with top-quality handicrafts and supply solutions. We believe that partnering with reliable and reputable suppliers like yourself will enable us to deliver exceptional products and services to our valued clientele. \n 
                Please include any additional information, such as product catalogs, brochures, or technical specifications that may assist us in evaluating your offerings. If you have any other products or services that align with our business needs, we would appreciate any recommendations or information you can provide.
                ",
                'target_date' => now()->addMonth(),
                'file_link' => 'https://tinyurl.com/mw5x2jzw',
                'is_reviewed' => false,
                'created_at' => now()
            ],
        );

        Request::insert($requests);
    }
}
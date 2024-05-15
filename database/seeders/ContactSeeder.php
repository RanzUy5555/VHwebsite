<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $contacts = array(
            [
                'id' => 1,
                'name' => 'Jessica Sue',
                'email' => 'jessicasue@gmail.com',
                'contact' => '09659313005',
                'message' => "My name is Jessica Sue, and I'm reaching out via the Virgilio Handicraft website. I have some questions about your products and services: Do you offer any discounts for bulk orders? Lastly, could you share details about the handicrafts supplies you have available for purchase?",
                'created_at' => now(),
            ],
           
        );

        Contact::insert($contacts);
    }

}
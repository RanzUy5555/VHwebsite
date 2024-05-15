<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Services\ActivityLogsService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $total_municipalities = Municipality::count();

        $users = array(
            // generate sample admin
             [
                'id' => 1,
                'first_name' => 'Virgilio ',
                'middle_name' => 'P',
                'last_name' => 'Handicraft',
                'gender' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09659312005',
                'email' => 'admin@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::ADMIN,
                'created_at' => now()
             ],
 
           // generate sample customer
            [
                'id' => 2,
                'first_name' => 'Dummy',
                'middle_name' => 'Dummy',
                'last_name' => 'Dummy',
                'gender' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09659312005',
                'email' => 'dummy@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::CUSTOMER,
                'created_at' => now()
            ],
            [
                'id' => 3,
                'first_name' => 'Juncarlo ',
                'middle_name' => 'Q',
                'last_name' => 'Torres',
                'gender' => 'male',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09279575483',
                'email' => 'tjun79996@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::CUSTOMER,
                'created_at' => now()
            ],
            [
                'id' => 4,
                'first_name' => 'Ranz ',
                'middle_name' => 'P',
                'last_name' => 'Somorot',
                'gender' => 'female',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09213087945',
                'email' => 'ranz.1721@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::CUSTOMER,
                'created_at' => now()
            ],
            [
                'id' => 5,
                'first_name' => 'Sam Reupert ',
                'middle_name' => 'M',
                'last_name' => 'Roxas',
                'gender' => 'male',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09472555730',
                'email' => 'samroxas2323@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::CUSTOMER,
                'created_at' => now()
            ],
        );
 
          User::insert($users);

          User::all()->each(function($user) use($service){
            $user
            ->addMedia(public_path("/tmp_files/avatars/$user->id.png"))
            ->preservingOriginal()
            ->toMediaCollection('avatar_image');

            $service->log_activity(model:User::find(1), event:'added', model_name: 'User', model_property_name: $user->name ?? 'Administrator');
        });
    }
}
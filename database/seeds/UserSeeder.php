<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

        	[
                'id' => '1',
                'name' => 'Test user',
                'email' => 'testuser@test.com',
                'email_verified_at' => now(),
        		'password' => Hash::make('password')
        	]
        ];

        User::insert($data);

    }
}

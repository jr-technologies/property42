<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'f_name' => 'unit',
                'l_name' => 'test',
                'email' => 'noman@gmail.com',
                'password' => '$2y$10$Dtqc4ZKEmskjiTn.IuiHQ.UxVbRD4PLEQuhcHjOSYqWCb5nGkpY4O',
                'access_token' => '$2y$10$tSM.PiN9BnMfyonqjHlwTONa1DPHbyQSAMOtmt4chJYXenGeYySHC',
                'country_id' => 1,
                'membership_plan_id' => 1
            ],
            [
                'f_name' => 'jr',
                'l_name' => 'team',
                'email' => 'jrteam@gmail.com',
                'password' => '$2y$10$Dtqc4ZKEmskjiTn.IuiHQ.UxVbRD4PLEQuhcHjOSYqWCb5nGkpY4O',
                'access_token' => null,
                'country_id' => 1,
                'membership_plan_id' => 1
            ],
        ]);
    }
}

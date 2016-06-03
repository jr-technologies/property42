<?php

use Illuminate\Database\Seeder;

class AgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agencies')->insert([
            [
                'agency' => 'JR',
                'user_id' => 1,
                'mobile' => 03044567051,
                'phone' => 03044567051,
                'email' => 'mrwaqas@gmail.com',
                'address' => 'Lahore',
                ]
        ]);
    }
}

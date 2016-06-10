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
                'logo'=>''
                ],
            [
            'agency' => 'JR Tech',
            'user_id' => 2,
            'mobile' => 030445267051,
            'phone' => 030445627051,
            'email' => 'mrwaqa2s@gmail.com',
            'address' => 'Lahore',
            'logo'=>'users/eccbc87e4b5ce2fe28308fd9f2a7baf3/agencies/4e075844d2e00e4c800c8c62716bed8c/4e075844d2e00e4c800c8c62716bed8c.png'
        ]
        ]);
    }
}

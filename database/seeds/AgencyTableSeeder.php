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
                'logo'=>'users/a87ff679a2f3e71d9181a67b7542122c/agencies/fe981f8a9c549000708b79eea5acead1/fe981f8a9c549000708b79eea5acead1.jpg'
                ],
            [
            'agency' => 'JR Tech',
            'user_id' => 2,
            'mobile' => 030445267051,
            'phone' => 030445627051,
            'email' => 'mrwaqa2s@gmail.com',
            'address' => 'Lahore',
            'logo'=>'users/e4da3b7fbbce2345d7772b0674a318d5/agencies/b7db4829ba1b5561a99be8a0a988988d/b7db4829ba1b5561a99be8a0a988988d.jpg'
        ]
        ]);
    }
}

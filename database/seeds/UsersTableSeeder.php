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
                  "f_name" => "waqas",
                  "l_name" => "qureshi",
                  "email" => "waqas@gmail.com",
                  "password" => '$2y$10$lVHrhSU/7SKckBYdRYFNYeO3ddcsh2CMP1FSFJeN4EPH0s7LYq9k2',
                  "access_token" => "",
                  "phone" => "65464654",
                  "mobile" => "6546456",
                  "fax" => "",
                  "address" => "654564564",
                  "zipcode" => "54564564",
                  "country_id" => 1,
                  "notification_settings" => 1,
                  "membership_plan_id" => 1
            ],
            [
                "f_name" => "noman",
                "l_name" => "tofail",
                "email" => "noman@gmail.com",
                "password" => '$2y$10$lVHrhSU/7SKckBYdRYFNYeO3ddcsh2CMP1FSFJeN4EPH0s7LYq9k2',
                "access_token" => "",
                "phone" => "65464654",
                "mobile" => "6546456",
                "fax" => "",
                "address" => "654564564",
                "zipcode" => "54564564",
                "country_id" => 1,
                "notification_settings" => 1,
                "membership_plan_id" => 1
            ],
        ]);
    }
}

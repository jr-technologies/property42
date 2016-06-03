<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersJsonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_json')->insert([
            [
                'user_id' => 1,
                'json'=>'{"id":1,"email":"noman@gmail.com","fName":"noman","lName":"tufail","phone":"65464654","mobile":"6546456","fax":"","address":"654564564","zipCode":"54564564","country":"Pakistan","membershipPlan":{"id":1,"name":"free","hot":0,"featured":0,"description":""},"agencies":[],"roles":[{"id":3,"name":"agent\/broker"}],"createdAt":"2016-05-10 06:43:53","updatedAt":"2016-05-10 06:43:53"}'
          ],
            [
                'user_id'=>2,
                'json'=>'{"id":2,"email":"waqas@gmail.com","fName":"waqas","lName":"qureshi","phone":"65464654","mobile":"6546456","fax":"","address":"654564564","zipCode":"54564564","country":"Pakistan","membershipPlan":{"id":1,"name":"free","hot":0,"featured":0,"description":""},"agencies":[],"roles":[{"id":3,"name":"agent\/broker"}],"createdAt":"2016-05-10 06:44:33","updatedAt":"2016-05-10 06:44:33"}'

            ]

        ]);
    }
}

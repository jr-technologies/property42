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
                'json'=>'{"id":1,"email":"1@gmail.com","fName":"1111","lName":"111","phone":"12","trustedAgent":1,"mobile":"12312","fax":"","address":"","zipCode":"","country":"Pakistan","roles":[{"id":3,"name":"agent\/broker"}],"membershipPlan":{"id":1,"name":"free","hot":0,"featured":0,"description":""},"agencies":[{"id":2,"name":"2","description":"","mobile":"1","phone":"1","address":"1","email":"12d@gmail.com","logo":"users/a87ff679a2f3e71d9181a67b7542122c/agencies/fe981f8a9c549000708b79eea5acead1/fe981f8a9c549000708b79eea5acead1.jpg"}],"createdAt":"2016-06-10 12:56:59","updatedAt":"2016-06-10 12:56:59"}'
          ],
            [
                'user_id'=>2,
                'json'=>'{"id":2,"email":"waqasjr@gmail.com","fName":"muhammad","lName":"waqas","trustedAgent":1,"phone":"030484504056","mobile":"03484504056","fax":"","address":"","zipCode":"","country":"Pakistan","roles":[{"id":3,"name":"agent\/broker"}],"membershipPlan":{"id":1,"name":"free","hot":0,"featured":0,"description":""},"agencies":[{"id":3,"name":"pakistan","description":"this is pakistan hero","mobile":"111","phone":"1111","address":"jrabc","email":"jr@gmail.com","logo":"users/e4da3b7fbbce2345d7772b0674a318d5/agencies/b7db4829ba1b5561a99be8a0a988988d/b7db4829ba1b5561a99be8a0a988988d.jpg"}],"createdAt":"2016-06-10 02:04:05","updatedAt":"2016-06-10 02:04:05"}'
            ]
        ]);
    }
}

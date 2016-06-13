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
                'json'=>'{"id":1,"email":"1@gmail.com","fName":"1111","lName":"111","phone":"12","mobile":"12312","fax":"","address":"","zipCode":"","country":"Pakistan","roles":[{"id":3,"name":"agent\/broker"}],"membershipPlan":{"id":1,"name":"free","hot":0,"featured":0,"description":""},"agencies":[{"id":2,"name":"2","description":"2","mobile":"1","phone":"1","address":"1","email":"12d@gmail.com","logo":"users\/eccbc87e4b5ce2fe28308fd9f2a7baf3\/agencies\/c81e728d9d4c2f636f067f89cc14862c\/c81e728d9d4c2f636f067f89cc14862c.png"}],"createdAt":"2016-06-10 12:56:59","updatedAt":"2016-06-10 12:56:59"}'
          ],
            [
                'user_id'=>2,
                'json'=>'{"id":2,"email":"waqasjr@gmail.com","fName":"muhammad","lName":"waqas","phone":"030484504056","mobile":"03484504056","fax":"","address":"","zipCode":"","country":"Pakistan","roles":[{"id":3,"name":"agent\/broker"}],"membershipPlan":{"id":1,"name":"free","hot":0,"featured":0,"description":""},"agencies":[{"id":3,"name":"pakistan","description":"this is pakistan hero","mobile":"111","phone":"1111","address":"jrabc","email":"jr@gmail.com","logo":"users\/eccbc87e4b5ce2fe28308fd9f2a7baf3\/agencies\/4e075844d2e00e4c800c8c62716bed8c\/4e075844d2e00e4c800c8c62716bed8c.png"}],"createdAt":"2016-06-10 02:04:05","updatedAt":"2016-06-10 02:04:05"}'
            ]
        ]);
    }
}

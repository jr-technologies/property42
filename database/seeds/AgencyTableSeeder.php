<?php

use App\Repositories\Providers\Providers\UsersRepoProvider;
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
        $users = (new UsersRepoProvider())->repo()->all();
        $finalRecord =[];
        foreach($users as $user) {
            $finalRecord[] =[
                'agency' => $user->name.''.$user->name,
                'user_id' => $user->id,
                'mobile' => 03044567051..rand(1,1000000),
                'phone' => 03044567051..rand(1,100000),
                'email' => $user->email.rand(1,200000000),
                'address' => 'Lahore',
                'logo' => 'users/a87ff679a2f3e71d9181a67b7542122c/agencies/fe981f8a9c549000708b79eea5acead1/fe981f8a9c549000708b79eea5acead1.jpg'
            ];
        }
         DB::table('agencies')->insert($finalRecord);
    }
}

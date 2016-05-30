<?php

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($b = 1; $b<=1; $b++)
        {
            $allProperties = [];

            for($a = 1; $a <= 200; $a++)

            {
                $temp = [];
                $temp['purpose_id'] = rand(1,3);
                $temp['property_sub_type_id'] = rand(1,19);
                $temp['block_id'] = rand(1,3);
                $temp['title'] = 'This is my property';
                $temp['description'] = 'This is my property and like to sale it'. rand(1,200002) ;
                $temp['price'] = rand(2000000,250000000);
                $temp['land_area'] = rand(1,20);
                $temp['land_unit_id'] = rand(1,4);
                $temp['contact_person'] = 'ab'.rand(1,100000);
                $temp['phone'] = '0321450405'. rand(1,3) ;
                $temp['mobile'] = '0321450405'. rand(1,10);
                $temp['property_status_id'] = rand(1,5);
                $temp['total_views'] = rand(1,100000);
                $temp['rating'] = rand(1,10);
                $temp['total_likes'] = rand(1,100000);
                $temp['email'] = 'jrpropedrty167@gmail.com'. rand(1,1000000) ;
                $temp['owner_id'] = 1;
                $temp['created_by'] = 1;
                $allProperties[] = $temp;
            }
            DB::table('properties')->insert($allProperties);
        }
    }
}

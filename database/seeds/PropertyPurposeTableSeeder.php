<?php

use Illuminate\Database\Seeder;

class PropertyPurposeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_purposes')->insert([
            ['id'=>1,'purpose'=>'for-sale', 'display_name' => 'For Sale'],
            ['id'=>2,'purpose'=>'for-rent', 'display_name' => 'For Rent']
        ]);

    }
}

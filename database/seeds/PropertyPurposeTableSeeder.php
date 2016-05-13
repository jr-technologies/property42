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
            ['purpose'=>'For Sale'],
            ['purpose'=>'Rent'],
            ['purpose'=>'Wanted']
        ]);

    }
}

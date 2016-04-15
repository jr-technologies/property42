<?php

use Illuminate\Database\Seeder;

class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_types')->insert([
            ['type' => 'dha'],
            ['type' => 'dha phase 2'],
            ['type' => 'dha phase 3']
        ]);
    }
}

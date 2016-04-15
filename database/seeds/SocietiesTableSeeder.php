<?php

use Illuminate\Database\Seeder;

class SocietiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('societies')->insert([
            ['city_id' => 1, 'society' => 'dha'],
            ['city_id' => 1, 'society' => 'dha phase 2'],
            ['city_id' => 1, 'society' => 'dha phase 3']
        ]);
    }
}

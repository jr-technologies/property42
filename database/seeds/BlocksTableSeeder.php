<?php

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blocks')->insert([
            ['society_id' => 1, 'block' => 'a'],
            ['society_id' => 1, 'block' => 'b'],
            ['society_id' => 1, 'block' => 'c']
        ]);
    }
}

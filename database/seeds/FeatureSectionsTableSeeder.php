<?php

use Illuminate\Database\Seeder;

class FeatureSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_sections')->insert([
            ['section' => 'main features', 'priority' => 1],
            ['section' => 'indoor features', 'priority' => 0],
            ['section' => 'outdoor features', 'priority' => 0],
        ]);
    }
}

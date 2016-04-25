<?php

use Illuminate\Database\Seeder;

class PropertyFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_features')->insert([
            [
                'feature_section_id' => 1,
                'feature' => 'bedrooms',
                'input_name' => 'bedrooms',
                'html_structure_id' => 2,
                'possible_values' => '',
                'priority' => 1
            ],
            [
                'feature_section_id' => 1,
                'feature' => 'baths',
                'input_name' => 'baths',
                'html_structure_id' => 2,
                'possible_values' => '',
                'priority' => 1
            ],
            [
                'feature_section_id' => 1,
                'feature' => 'floor',
                'input_name' => 'floor',
                'html_structure_id' => 3,
                'possible_values' => 'first, second, third, fourth',
                'priority' => 1
            ]
        ]);
    }
}

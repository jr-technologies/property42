<?php

use Illuminate\Database\Seeder;

class PropertySubTypeAssignedFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_sub_type_assigned_features')->insert([
            ['property_sub_type_id' => 1, 'property_feature_id'=>1],
            ['property_sub_type_id' => 1, 'property_feature_id'=>2],
            ['property_sub_type_id' => 1, 'property_feature_id'=>3],
        ]);
    }
}

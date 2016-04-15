<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/14/2016
 * Time: 4:53 PM
 */

class PropertySubTypeTable extends Seeder
{
 public function run()
 {
     DB::table('property_sub_types')->insert([
         ['property_type_id'=>1,'sub_type'=>'usa'],
         ['property_type_id'=>2,'sub_type'=>'usa1'],
         ['property_type_id'=>3,'sub_type'=>'usa2']
     ]);
 }
}
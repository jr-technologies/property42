<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/14/2016
 * Time: 4:53 PM
 */

class PropertyStatusTable extends Seeder
{
 public function run()
 {
     DB::table('property_statuses')->insert([
         ['status'=>'usa'],
         ['status'=>'usa1'],
         ['status'=>'usa2'],

     ]);
 }
}
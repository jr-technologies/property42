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
     /**
      * Please Never Ever change the Status Position
      */
     DB::table('property_statuses')->insert([
         ['status'=>'Active'],
         ['status'=>'Pending'],
         ['status'=>'Deleted'],
         ['status'=>'Rejected'],
         ['status'=>'Approved'],
         ['status'=>'Expired'],
     ]);
 }
}
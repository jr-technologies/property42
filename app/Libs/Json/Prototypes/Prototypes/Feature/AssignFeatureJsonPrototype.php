<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/13/2016
 * Time: 4:56 PM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Feature;


use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class AssignFeatureJsonPrototype extends JsonPrototype implements  JsonPrototypeInterface
{
   public $sections = [];
}
<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 10:14 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property\Owner;
use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

class PropertyOwnerJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $Id = null;
    public $name = "";
    public $email = "";
    public $phone  = "";
    public $mobile  = "";
    public $address  = "";
    /* @var $agency PropertyAgencyJsonPrototype ::class*/
    public $agency  = null;
    public $role =[];
}
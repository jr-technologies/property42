<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/25/2016
 * Time: 10:03 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\Property;


use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\Type\PropertyTypeJsonPrototype;

class PropertyJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id ="";
    public $owner = null;
    public $purpose = "";
    /* @var $type PropertyTypeJsonPrototype::class */
    public $type;
    /* @var $location PropertyLocationJsonPrototype::class*/
    public $location =null;
    public $title = "";
    public $description = "";
    public $price ="";
    /* @var $land PropertyLandJson0Prototype::class */
    public $land = "";
    /* @var $propertyStatus PropertyStatusJsonPrototype::class*/
    public $propertyStatus =null;
    public $isFeatured = "";
    public $isHot ="";
    public $isDeleted ="";
    public $createdBy = "";
    public $totalViews ="";
    public $rating ="";
    public $totalLikes = "";
    /* @var $Documents PropertyDocumentsJsonPrototype::class*/
    public $documents = [];
    public $features = [];
}
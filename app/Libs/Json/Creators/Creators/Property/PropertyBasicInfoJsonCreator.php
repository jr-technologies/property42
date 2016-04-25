<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property;

use App\DB\Providers\SQL\Models\Property;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;

class PropertyJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(Property $property = null)
    {
        $this->model = $property;
        $this->prototype = new PropertyJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        
        return $this->prototype;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

namespace App\Traits\Property;

use App\DB\Providers\SQL\Models\Property;
use App\Libs\Helpers\LandArea;
use App\Traits\AppTrait;

trait PropertyPriceUnitHelper
{
    use AppTrait;

    public function convertPropertyAreaToLowestUnit(Property $property)
    {
        $property->landArea = LandArea::convert(config('constants.LAND_UNITS')[$property->landUnitId], 'square feet', $property->landArea);
        return $property;
    }
}
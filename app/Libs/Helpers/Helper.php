<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/14/2016
 * Time: 12:27 PM
 */

namespace App\Libs\Helpers;


class Helper
{
    public static function propertyToArray(array $objects, $property)
    {
        $array = [];
        foreach($objects as $object)
        {
            $array[] = $object->$property;
        }
        return $array;
    }
}
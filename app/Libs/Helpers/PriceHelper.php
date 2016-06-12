<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 6/7/2016
 * Time: 8:32 AM
 */

namespace App\Libs\Helpers;


class PriceHelper extends Helper
{
    
    public static function numberToRupees($number)
    {
        $length = strlen($number."");
        if($length > 3)
            $result = ceil(doubleval(substr('100000000000000000', 0, (($length % 2) == 0)?$length:($length-1) )));
        else
            $result = 0;

        $shortResult = $number/$result;
        $value =  substr($shortResult."", 0, 4);

        $price_unit = '';
        if($length > 3 && $length < 6){
            $price_unit = 'thousand';
        }
        elseif($length > 5 && $length < 8){
            $price_unit = 'lakh';
        }
        elseif($length > 7 && $length < 10){
            $price_unit = 'crore';
        }

        elseif($length > 9 && $length < 12){
            $price_unit = 'Arab';
        }
        return  $value." ".$price_unit;
    }
}
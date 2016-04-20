<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\City;


use App\Transformers\Request\RequestTransformer;


class GetBlocksBySocietyTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'societyId'=>'society_id'
        ];
    }
}
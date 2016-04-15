<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/8/2016
 * Time: 10:27 AM
 */

namespace App\Transformers\Request\Society;


use App\Transformers\Request\RequestTransformer;

class UpdateSocietyTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
                'id'=>$this->request->input('society_id'),
                'cityId'=>$this->request->input('city_id'),
                'society'=>$this->request->input('society_name')
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\AddToFavourite;


use App\Transformers\Request\RequestTransformer;


class DeleteMultiFavouritePropertyTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'propertyIds'=> $this->request->input('property_ids'),
            'userId'=> $this->request->input('user_id'),
        ];
    }
}
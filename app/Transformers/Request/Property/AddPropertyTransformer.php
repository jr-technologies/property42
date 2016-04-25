<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Property;


use App\Transformers\Request\RequestTransformer;


class AddPropertyTransformer extends RequestTransformer
{
    public function transform()
    {
       return [
           /* property info */
           'ownerId' => $this->request->get('owner_id'),
           'purposeId' => $this->request->get('purpose_id'),
           'subTypeId' => $this->request->get('sub_type_id'),
           'blockId' => $this->request->get('block_id'),
           'title' => $this->request->get('title'),
           'description' => $this->request->get('description'),
           'price' => $this->request->get('price'),
           'landArea' => $this->request->get('land_area'),
           'landUnitId' => $this->request->get('land_unit_id'),

           /* contact information */
           'contactPerson' => $this->request->get('contact_person'),
           'phone' => $this->request->get('phone'),
           'mobile' => $this->request->get('mobile'),
           'email' => $this->request->get('email'),
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Property;


use App\Transformers\Request\RequestTransformer;


class UpdatePropertyTransformer extends RequestTransformer
{
    public function transformExtraFeatures()
    {
        $extraFeatures = [];
        foreach($this->request->all() as $input => $value)
        {
            if(!in_array($input,$this->staticInputs()))
                $extraFeatures[$input] = $value;
        }
        return $extraFeatures;
    }
    public function transform()
    {
       return array_merge([
           /* property info */
           'propertyId' => $this->request->input('property_id'),
           'ownerId' => $this->request->input('owner_id'),
           'purposeId' => $this->request->input('purpose_id'),
           'subTypeId' => $this->request->input('sub_type_id'),
           'blockId' => $this->request->input('block_id'),
           'title' => $this->request->input('title'),
           'description' => $this->request->input('description'),
           'price' => $this->request->input('price'),
           'landArea' => $this->request->input('land_area'),
           'landUnitId' => $this->request->input('land_unit_id'),

           /* contact information */
           'contactPerson' => $this->request->input('contact_person'),
           'phone' => $this->request->input('phone'),
           'mobile' => $this->request->input('mobile'),
           'email' => $this->request->input('email'),
        ], $this->transformExtraFeatures());
    }

    private function staticInputs()
    {
        return [
            'property_id',
            'owner_id',
            'purpose_id',
            'sub_type_id',
            'block_id',
            'title',
            'description',
            'price',
            'land_area',
            'land_unit_id',
            'contact_person',
            'phone',
            'mobile',
            'email'
        ];
    }
}
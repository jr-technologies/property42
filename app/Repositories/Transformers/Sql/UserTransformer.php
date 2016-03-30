<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/16/2016
 * Time: 11:07 AM
 */

namespace App\Repositories\Transformers\Sql;

use App\Models\Sql\User;
use App\Models\Sql\UserDocument;
use App\Repositories\Interfaces\Transformers\RepositoryTransformerInterface;

class UserTransformer extends SqlTransformer implements RepositoryTransformerInterface
{
    public function transform($user)
    {
        if($user == null){return null;}
        $user = ($user->document == null)?null:$user->document->decode();
        if($user == null){return null;}

        return (object)[
            'id' => $user->id,
            'email' => $user->email,
            'f_Name' => $user->fName,
            'l_Name' => $user->lName,
            'phone' => $user->phone,
            'mobile' => $user->mobile,
            'fax' => $user->fax,
            'address' => $user->address,
            'zipCode' => $user->zipCode,
            'country' => $user->country,
            'membershipPlan' => [
                'id' => $user->id,
                'plan_name'=>$user->membershipPlan->id,
                'hot' => $user->membershipPlan->hot,
                'featured' => $user->membershipPlan->featured,
                'description' => $user->membershipPlan->description
            ],
            'agencies' => [],
        ];
    }
}
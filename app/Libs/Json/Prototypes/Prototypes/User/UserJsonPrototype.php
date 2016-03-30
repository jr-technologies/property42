<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/25/2016
 * Time: 11:46 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\User;

use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;
use App\Models\Sql\User;

class UserJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function prototype()
    {
        $jsonObj = (object)[
            'id' => $this->user->id,
            'email' => $this->user->email,
            'fName' => $this->user->f_name,
            'lName' => $this->user->l_name,
            'phone' => $this->user->phone,
            'mobile' => $this->user->mobile,
            'fax' => $this->user->fax,
            'address' => $this->user->address,
            'zipCode' => $this->user->zipcode,
            'country' => $this->user->country->country,
            'membershipPlan' => $this->membershipPlan(),
            'agencies' => $this->agencies()
        ];
        return json_encode($jsonObj);
    }

    public function membershipPlan()
    {
        return (object)[
            'id' => $this->user->membershipPlan->id,
            'plan_name' => $this->user->membershipPlan->plan_name,
            'hot' => $this->user->membershipPlan->hot,
            'featured' => $this->user->membershipPlan->featured,
            'description' => $this->user->membershipPlan->description,
        ];
    }

    public function agencies()
    {
        return (object)$this->user->agencies->toArray();
    }
}
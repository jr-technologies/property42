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

class UserBasicInfoJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
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
            'access_token' => $this->user->access_token,
        ];
        return json_encode($jsonObj);
    }
}
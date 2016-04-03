<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\User;

use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\User\AgencyJsonPrototype;
use App\DB\Providers\SQL\Models\Agency;

class AgencyJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(Agency $agency = null)
    {
        $this->model = $agency;
        $this->prototype = new AgencyJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->address = $this->model->address;
        $this->prototype->description  = $this->model->description;
        $this->prototype->email = $this->model->email;
        $this->prototype->mobile = $this->model->mobile;
        $this->prototype->name = $this->model->name;
        $this->prototype->phone = $this->model->phone;

        return $this->prototype;
    }
}
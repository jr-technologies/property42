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
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use App\Objects\User;

class UserJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $membershipPlanJsonCreator = null;
    private $agencyJsonCreator = null;

    public function __construct(User $user = null)
    {
        $this->model = $user;
        $this->prototype = new UserJsonPrototype();

        $this->membershipPlanJsonCreator = new MembershipPlanJsonCreator($this->model->membershipPlan);
        $this->agencyJsonCreator = new AgencyJsonCreator();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->email = $this->model->email;
        $this->prototype->fName = $this->model->fName;
        $this->prototype->lName = $this->model->lName;
        $this->prototype->phone = $this->model->phone;
        $this->prototype->mobile = $this->model->mobile;
        $this->prototype->fax = $this->model->fax;
        $this->prototype->address = $this->model->address;
        $this->prototype->zipCode = $this->model->zipCode;
        $this->prototype->country = $this->model->country->name;
        $this->prototype->membershipPlan = $this->membershipPlanJsonCreator->create();
        $this->prototype->agencies = $this->agencies();
        return $this->prototype;
    }

    public function agencies()
    {
        $agencies = [];
        $userAgencies = $this->model->agencies;
        foreach($userAgencies as $agency)
        {
            $agencies[] = $this->agencyJsonCreator->setModel($agency)->create();
        }
        return $agencies;
    }
}